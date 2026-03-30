<?php

namespace App\Http\Controllers;

use App\Models\StudentRegist;
use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\Student;
use App\Models\Major;
use App\Models\Submajor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;
        $curriculumTypes = collect();

        if ($student && $student->curriculum) {
            $curriculumTypes = $student->curriculum->curriculum_type()
                ->where('submajor_id', $student->submajor_id)
                ->with(['curriculum_subject.subject_category.subject_type'])
                ->get();

            // Get all passed subjects for this user with their credit info and category
            $passedRegistrations = StudentRegist::where('user_id', $user->id)
                ->where('status', 'Pass')
                ->with('subject')
                ->get();

            foreach ($curriculumTypes as $type) {
                $totalNeeded = 0;
                $totalEarned = 0;

                foreach ($type->curriculum_subject as $curriculumSubject) {
                    $category = $curriculumSubject->subject_category;
                    if ($category) {
                        $totalNeeded += $category->credit_needed;

                        // Get all type_names belonging to this category
                        $categoryTypeNames = $category->subject_type->pluck('type_name');

                        // Calculate earned credits by matching subject's type_name against the category's type_names
                        $categoryEarned = $passedRegistrations->filter(function ($reg) use ($categoryTypeNames) {
                            return $reg->subject &&
                                $categoryTypeNames->contains($reg->subject->type_name);
                        })->sum(function ($reg) {
                            return $reg->subject->subject_credit;
                        });

                        // We shouldn't count more than needed for a category in the overall progress
                        $totalEarned += min($categoryEarned, $category->credit_needed);
                    }
                }

                $type->total_needed = $totalNeeded;
                $type->total_earned = $totalEarned;
                $type->progress_percentage = $totalNeeded > 0 ? min(100, round(($totalEarned / $totalNeeded) * 100)) : 0;
            }
        }

        return view('user.index', compact('curriculumTypes'));
    }


    public function detail(Request $request, $id)
    {
        $subject_types = SubjectType::query()->whereHas('subject_category.curriculum_subject.curriculum_type.curriculum.student.user', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();

        $subject_type_names = $subject_types->pluck('type_name')->unique();

        // Group by type_name instead of subject_type->id to avoid ambiguous belongsTo
        $groupedPassedSubjects = StudentRegist::query()->with(['subject.subject_own'])->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($subject_type_names) {
            $query->whereIn('type_name', $subject_type_names);
        })->get()->groupBy(function ($reg) {
            return $reg->subject->type_name;
        });

        $student = Student::where('user_id', $id)->first();
        $curriculum = $student->curriculum;

        // Match curriculum_type by the student's submajor and selected type_name
        $selectedTypeName = $request->query('type_name');
        $curriculumTypeQuery = $curriculum->curriculum_type()->with([
            'curriculum_subject.subject_category.subject_type.subjects.subject_own',
            'curriculum_subject.subject_category.subject_type.subjects.subject_curriculum'
        ])->where('submajor_id', $student->submajor_id);

        if ($selectedTypeName) {
            $curriculumTypeQuery->where('type_name', $selectedTypeName);
        }

        $curriculumType = $curriculumTypeQuery->first();

        // If not found, return view with error flag
        if (!$curriculumType) {
            return view('user.detail', [
                'curriculum_subjects' => collect(),
                'progress' => null,
                'student' => $student,
                'error' => 'ไม่พบข้อมูลโครงการหลักสูตรที่ตรงกับวิชาเอกของคุณ โปรดติดต่อผู้ดูแลระบบ'
            ]);
        }

        // Logic for Major Elective (วิชาชีพเลือก) and Required (วิชาชีพบังคับ) filtering

        // Special logic for Minor Subjects (วิชาโท)
        // If not "ระบบสารสนเทศ", find the minor submajor with most credits
        $isNotInfoSys = $student->submajor && $student->submajor->submajor_name_thai != 'ระบบสารสนเทศ';
        $bestMinorSubmajorId = null;

        if ($isNotInfoSys) {
            $minorRegistrations = StudentRegist::where('user_id', $id)
                ->where('status', 'Pass')
                ->whereHas('subject.subject_type', function ($q) {
                    $q->where('type_name', 'วิชาโท');
                })
                ->with('subject.subject_own')
                ->get();

            if ($minorRegistrations->isNotEmpty()) {
                $groupedBySubmajor = $minorRegistrations->groupBy(function ($reg) {
                    return $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                });

                $bestMinorSubmajorId = $groupedBySubmajor->sortByDesc(function ($group) {
                    return $group->sum(fn($reg) => $reg->subject->subject_credit);
                })->keys()->first();
            }
        }

        // Filter subjects in the curriculum structure
        // For major=1: collect วิชาชีพบังคับ subjects from other submajors to show under วิชาชีพเลือก
        $otherSubmajorRequiredSubjects = collect();

        if ($curriculumType) {
            foreach ($curriculumType->curriculum_subject as $cs) {
                if ($cs->subject_category) {
                    foreach ($cs->subject_category->subject_type as $st) {
                        if ($st->type_name == 'วิชาชีพบังคับ') {
                            // Partition subjects into own and other-submajor
                            $partitioned = $st->subjects->partition(function ($subject) use ($student) {
                                if (!$subject->subject_own)
                                    return false;
                                if ($student->major_id == 1) {
                                    return $subject->subject_own->submajor_id == $student->submajor_id;
                                } else {
                                    return $subject->subject_own->major_id == $student->major_id;
                                }
                            });

                            // Keep only own subjects in วิชาชีพบังคับ
                            $st->setRelation('subjects', $partitioned[0]);

                            // Collect other-submajor subjects (for major=1) to add to วิชาชีพเลือก
                            if ($student->major_id == 1) {
                                $otherSubmajorRequiredSubjects = $otherSubmajorRequiredSubjects->concat($partitioned[1]);
                            }
                        }
                    }
                }
            }

            // Add other-submajor วิชาชีพบังคับ subjects to วิชาชีพเลือก section
            if ($otherSubmajorRequiredSubjects->isNotEmpty()) {
                foreach ($curriculumType->curriculum_subject as $cs) {
                    if ($cs->subject_category) {
                        foreach ($cs->subject_category->subject_type as $st) {
                            if (trim($st->type_name) == 'วิชาชีพเลือก') {
                                $st->setRelation('subjects', $st->subjects->concat($otherSubmajorRequiredSubjects)->unique('id'));
                                break 2;
                            }
                        }
                    }
                }
            }
        }

        // Calculate overall progress for this curriculum type
        $totalNeeded = 0;
        $totalEarned = 0;

        if ($curriculumType) {
            $passedRegistrations = StudentRegist::where('user_id', $id)
                ->where('status', 'Pass')
                ->with(['subject.subject_own'])
                ->get();


            // Filter passed registrations for 'วิชาโท' if not IS
            if ($isNotInfoSys && $bestMinorSubmajorId !== null) {
                $passedRegistrations = $passedRegistrations->filter(function ($reg) use ($bestMinorSubmajorId) {
                    if ($reg->subject && $reg->subject->type_name == 'วิชาโท') {
                        $regSubmajorId = $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                        return $regSubmajorId == $bestMinorSubmajorId;
                    }
                    return true;
                });

                // Also update the groupedPassedSubjects for the view (keyed by type_name)
                if (isset($groupedPassedSubjects['วิชาโท'])) {
                    $groupedPassedSubjects['วิชาโท'] = $groupedPassedSubjects['วิชาโท']->filter(function ($reg) use ($bestMinorSubmajorId) {
                        $regSubmajorId = $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                        return $regSubmajorId == $bestMinorSubmajorId;
                    });
                }
            }

            // Identify misplaced 'วิชาชีพบังคับ' (belonging to other majors/submajors)
            // They should be treated as 'วิชาชีพเลือก'
            $electiveTypeId = null;
            $electiveTypeRef = null;

            // Find the target 'วิชาชีพเลือก' in this specific curriculum type
            foreach ($curriculumType->curriculum_subject as $cs) {
                if ($cs->subject_category) {
                    foreach ($cs->subject_category->subject_type as $st) {
                        if (trim($st->type_name) == 'วิชาชีพเลือก') {
                            $electiveTypeId = $st->id;
                            $electiveTypeRef = $st;
                            break 2;
                        }
                    }
                }
            }

            $passedRegistrations = $passedRegistrations->map(function ($reg) use ($student, $electiveTypeId) {
                if ($reg->subject && trim($reg->subject->type_name) == 'วิชาชีพบังคับ') {
                    if (!$reg->subject->subject_own)
                        return $reg;

                    $isOwn = false;
                    if ($student->major_id == 1) {
                        $isOwn = ($reg->subject->subject_own->submajor_id == $student->submajor_id);
                    } else {
                        $isOwn = ($reg->subject->subject_own->major_id == $student->major_id);
                    }

                    // If not own, and we have an elective type, re-bind it
                    if (!$isOwn && $electiveTypeId) {
                        $reg->is_misplaced_required = true;
                    }
                }
                return $reg;
            });

            // Filter out 'วิชาชีพบังคับ' that are not own (only if we didn't mark them as misplaced)
            // Actually, keep them but we will handle them in the credit loop


            // Re-group 'วิชาชีพบังคับ' and 'วิชาชีพเลือก' for groupedPassedSubjects (keyed by type_name)
            if ($electiveTypeId) {
                if (isset($groupedPassedSubjects['วิชาชีพบังคับ'])) {
                    $requiredRegs = $groupedPassedSubjects['วิชาชีพบังคับ'];

                    // Split into own and misplaced
                    $partitioned = $requiredRegs->partition(function ($reg) use ($student) {
                        if (!$reg->subject || !$reg->subject->subject_own)
                            return false;
                        if ($student->major_id == 1) {
                            return $reg->subject->subject_own->submajor_id == $student->submajor_id;
                        } else {
                            return $reg->subject->subject_own->major_id == $student->major_id;
                        }
                    });

                    $ownRequired = $partitioned[0];
                    $misplacedRequired = $partitioned[1];

                    // Update Required group
                    $groupedPassedSubjects['วิชาชีพบังคับ'] = $ownRequired;

                    // Move misplaced to Elective group
                    if ($misplacedRequired->isNotEmpty()) {
                        $existingElectives = $groupedPassedSubjects->get('วิชาชีพเลือก', collect());
                        $groupedPassedSubjects['วิชาชีพเลือก'] = $existingElectives->concat($misplacedRequired);

                        // Also add to the subjects list of the elective type for the view's collapse section
                        if ($electiveTypeRef) {
                            $newSubjects = $misplacedRequired->pluck('subject')->unique('id');
                            $electiveTypeRef->setRelation('subjects', $electiveTypeRef->subjects->concat($newSubjects)->unique('id'));
                        }
                    }
                }
            }

            foreach ($curriculumType->curriculum_subject as $curriculumSubject) {
                $category = $curriculumSubject->subject_category;
                if ($category) {
                    $totalNeeded += $category->credit_needed;

                    $categoryTypeNames = $category->subject_type->pluck('type_name');

                    $categoryEarned = $passedRegistrations->filter(function ($reg) use ($categoryTypeNames, $electiveTypeId, $category) {
                        if (!$reg->subject)
                            return false;

                        // Standard matching: check if subject's type_name is in this category
                        if ($categoryTypeNames->contains($reg->subject->type_name)) {
                            // If it's a Required subject, check if it's "own"
                            if ($reg->subject->type_name == 'วิชาชีพบังคับ') {
                                if (isset($reg->is_misplaced_required) && $reg->is_misplaced_required)
                                    return false;
                            }
                            return true;
                        }

                        // Special case: Misplaced Required counting towards Elective category
                        if (isset($reg->is_misplaced_required) && $reg->is_misplaced_required) {
                            // Does this category contain Electives?
                            return $category->subject_type->pluck('id')->contains($electiveTypeId);
                        }

                        return false;
                    })->sum(function ($reg) {
                        return $reg->subject->subject_credit;
                    });

                    $totalEarned += min($categoryEarned, $category->credit_needed);
                }
            }
        }

        $progress = [
            'total_needed' => $totalNeeded,
            'total_earned' => $totalEarned,
            'percentage' => $totalNeeded > 0 ? min(100, round(($totalEarned / $totalNeeded) * 100)) : 0,
            'type_name' => $curriculumType ? $curriculumType->type_name : 'N/A'
        ];

        $curriculum_subjects = $curriculumType ? $curriculumType->curriculum_subject : collect();

        $bestMinorSubmajorName = null;
        if ($bestMinorSubmajorId && $bestMinorSubmajorId !== 'none') {
            $bestMinorSubmajorName = Submajor::find($bestMinorSubmajorId)->submajor_name_thai ?? null;
        }

        return view('user.detail', compact('groupedPassedSubjects', 'curriculum_subjects', 'progress', 'isNotInfoSys', 'bestMinorSubmajorName', 'student'));
    }


    public function show($id, $type_id)
    {
        $student = Student::where('user_id', $id)->first();
        $curriculum_id = $student->curriculum_id;
        $subjectType = SubjectType::find($type_id);

        $passedSubjects = StudentRegist::query()->with(['subject.subject_curriculum', 'subject.subject_own'])->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($type_id, $curriculum_id, $subjectType, $student) {
            $query->whereHas('subject_curriculum', function ($q) use ($curriculum_id) {
                $q->where('curriculum_id', $curriculum_id);
            });

            if ($subjectType && $subjectType->type_name == 'วิชาชีพบังคับ') {
                $query->where('type_name', 'วิชาชีพบังคับ')
                    ->whereHas('subject_own', function ($q) use ($student) {
                        if ($student->major_id == 1) {
                            $q->where('submajor_id', $student->submajor_id);
                        } else {
                            $q->where('major_id', $student->major_id);
                        }
                    });
            } elseif ($subjectType && $subjectType->type_name == 'วิชาชีพเลือก') {
                $query->where(function ($q) use ($student) {
                    // Own electives
                    $q->where('type_name', 'วิชาชีพเลือก')
                        ->orWhere(function ($subQ) use ($student) {
                            // Misplaced required
                            $subQ->where('type_name', 'วิชาชีพบังคับ')
                                ->whereHas('subject_own', function ($ownQ) use ($student) {
                                if ($student->major_id == 1) {
                                    $ownQ->where('submajor_id', '!=', $student->submajor_id);
                                } else {
                                    $ownQ->where('major_id', '!=', $student->major_id);
                                }
                            });
                        });
                });
            } else {
                $query->where('type_name', $subjectType->type_name);
            }
        })->get();

        $passSubjectId = $passedSubjects->pluck('subject_id')->toArray();

        if ($subjectType && $subjectType->type_name == 'วิชาชีพเลือก') {
            // Unpassed for วิชาชีพเลือก: include own electives + วิชาชีพบังคับ from other submajors
            $unpassedQuery = Subject::query()
                ->with(['subject_curriculum', 'subject_own'])
                ->whereHas('subject_curriculum', function ($q) use ($curriculum_id) {
                    $q->where('curriculum_id', $curriculum_id);
                })
                ->whereNotIn('id', $passSubjectId)
                ->where(function ($q) use ($student) {
                    // Own electives
                    $q->where('type_name', 'วิชาชีพเลือก')
                        ->orWhere(function ($subQ) use ($student) {
                            // วิชาชีพบังคับ from other submajors
                            $subQ->where('type_name', 'วิชาชีพบังคับ')
                                ->whereHas('subject_own', function ($ownQ) use ($student) {
                                    if ($student->major_id == 1) {
                                        $ownQ->where('submajor_id', '!=', $student->submajor_id);
                                    } else {
                                        $ownQ->where('major_id', '!=', $student->major_id);
                                    }
                                });
                        });
                });
        } else {
            $unpassedQuery = Subject::query()
                ->with(['subject_curriculum', 'subject_own'])
                ->where('type_name', $subjectType->type_name)
                ->whereHas('subject_curriculum', function ($q) use ($curriculum_id) {
                    $q->where('curriculum_id', $curriculum_id);
                })
                ->whereNotIn('id', $passSubjectId);

            if ($subjectType && $subjectType->type_name == 'วิชาชีพบังคับ') {
                $unpassedQuery->whereHas('subject_own', function ($q) use ($student) {
                    if ($student->major_id == 1) {
                        $q->where('submajor_id', $student->submajor_id);
                    } else {
                        $q->where('major_id', $student->major_id);
                    }
                });
            }
        }

        $unpassedSubjects = $unpassedQuery->get();

        return view('user.show', compact('passedSubjects', 'unpassedSubjects', 'subjectType'));
    }

    public function registrations()
    {
        $id = Auth::id();
        $registrations = StudentRegist::with('subject.subject_own')
            ->where('user_id', $id)
            ->get();

        return view('user.registrations', compact('registrations'));
    }

    public function addSubject()
    {
        $user_id = Auth::user()->id;
        $subject_regist = StudentRegist::where('user_id', $user_id)->pluck('subject_id')->toArray();
        $subjects = Subject::whereNotIn('id', $subject_regist)->get();
        return view('user.add_subject', compact('subjects'));
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
            'status' => 'required|string',
        ]);

        foreach ($request->subject_ids as $subject_id) {
            StudentRegist::create([
                'user_id' => Auth::user()->id,
                'subject_id' => $subject_id,
                'status' => $request->status,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'เพิ่มวิชาเรียบร้อยแล้ว');
    }

    public function editStudent()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $majors = Major::all();
        $submajors = Submajor::all();
        return view('user.edit_student', compact('student', 'majors', 'submajors'));
    }

    public function updateStudent(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
            'submajor_id' => 'nullable|exists:submajors,id',
        ]);

        $student = Student::where('user_id', Auth::id())->first();
        if ($student) {
            $student->update([
                'student_name' => $request->student_name,
                'major_id' => $request->major_id,
                'submajor_id' => $request->submajor_id,
            ]);
            return redirect()->route('user.index')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
        }

        return redirect()->back()->with('error', 'ไม่พบข้อมูลนักศึกษา');
    }
}
