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
                ->with(['curriculum_subject.subject_category'])
                ->get();

            // Get all passed subjects for this user with their credit info and category
            $passedRegistrations = StudentRegist::where('user_id', $user->id)
                ->where('status', 'Pass')
                ->with('subject.subject_type')
                ->get();

            foreach ($curriculumTypes as $type) {
                $totalNeeded = 0;
                $totalEarned = 0;

                foreach ($type->curriculum_subject as $curriculumSubject) {
                    $category = $curriculumSubject->subject_category;
                    if ($category) {
                        $totalNeeded += $category->credit_needed;

                        // Calculate earned credits for this category
                        $categoryEarned = $passedRegistrations->filter(function ($reg) use ($category) {
                            return $reg->subject && 
                                   $reg->subject->subject_type && 
                                   $reg->subject->subject_type->subject_category_id == $category->id;
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
        $subject_type = SubjectType::query()->whereHas('subject_category.curriculum_subject.curriculum_type.curriculum.student.user', function ($query) use ($id) {
            $query->where('id', $id);
        })->pluck('id');
        
        $groupedPassedSubjects = StudentRegist::query()->with(['subject.subject_own', 'subject.subject_type'])->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($subject_type) {
            $query->whereIn('subject_type_id', $subject_type);
        })->get()->groupBy('subject.subject_type_id');
        
        $student = Student::where('user_id', $id)->first();
        $curriculum = $student->curriculum;
        
        // Match curriculum_type by the student's submajor
        $curriculumType = $curriculum->curriculum_type()->with([
            'curriculum_subject.subject_category.subject_type.subjects.subject_own',
            'curriculum_subject.subject_category.subject_type.subjects.subject_curriculum'
        ])->where('submajor_id', $student->submajor_id)->first();
        
        // If not found, return view with error flag
        if (!$curriculumType) {
            return view('user.detail', [
                'curriculum_subjects' => collect(),
                'progress' => null,
                'student' => $student,
                'error' => 'ไม่พบข้อมูลโครงการหลักสูตรที่ตรงกับวิชาเอกของคุณ โปรดติดต่อผู้ดูแลระบบ'
            ]);
        }

        // Check SubmajorMeasure for elective filtering
        $measure = \App\Models\SubmajorMeasure::where('curriculum_type_id', $curriculumType->id)
            ->where('submajor_id', $student->submajor_id)
            ->first();
        
        $isElectiveAllowed = $measure && $measure->type == 'allowed';
        
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
                $groupedBySubmajor = $minorRegistrations->groupBy(function($reg) {
                    return $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                });

                $bestMinorSubmajorId = $groupedBySubmajor->sortByDesc(function($group) {
                    return $group->sum(fn($reg) => $reg->subject->subject_credit);
                })->keys()->first();
            }
        }

        // Filter subjects in the curriculum structure
        if ($curriculumType) {
            foreach ($curriculumType->curriculum_subject as $cs) {
                if ($cs->subject_category) {
                    foreach ($cs->subject_category->subject_type as $st) {
                        if (!$isElectiveAllowed && $st->type_name == 'วิชาชีพเลือก') {
                            $st->setRelation('subjects', $st->subjects->filter(function($subject) use ($student) {
                                return $subject->subject_own && $subject->subject_own->submajor_id == $student->submajor_id;
                            }));
                        }
                        if ($st->type_name == 'วิชาชีพบังคับ') {
                            $st->setRelation('subjects', $st->subjects->filter(function($subject) use ($student) {
                                return $subject->subject_own 
                                    && $subject->subject_own->major_id == $student->major_id 
                                    && $subject->subject_own->submajor_id == $student->submajor_id;
                            }));
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
                ->with(['subject.subject_type', 'subject.subject_own'])
                ->get();

            // Filter passed registrations for 'วิชาชีพเลือก' if not allowed
            if (!$isElectiveAllowed) {
                $passedRegistrations = $passedRegistrations->filter(function ($reg) use ($student) {
                    if ($reg->subject && $reg->subject->subject_type && $reg->subject->subject_type->type_name == 'วิชาชีพเลือก') {
                        return $reg->subject->subject_own && $reg->subject->subject_own->submajor_id == $student->submajor_id;
                    }
                    return true;
                });
            }

            // Filter passed registrations for 'วิชาโท' if not IS
            if ($isNotInfoSys && $bestMinorSubmajorId !== null) {
                $passedRegistrations = $passedRegistrations->filter(function ($reg) use ($bestMinorSubmajorId) {
                    if ($reg->subject && $reg->subject->subject_type && $reg->subject->subject_type->type_name == 'วิชาโท') {
                        $regSubmajorId = $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                        return $regSubmajorId == $bestMinorSubmajorId;
                    }
                    return true;
                });

                // Also update the groupedPassedSubjects for the view
                foreach ($groupedPassedSubjects as $typeId => $registrations) {
                    $firstReg = $registrations->first();
                    if ($firstReg && $firstReg->subject && $firstReg->subject->subject_type && $firstReg->subject->subject_type->type_name == 'วิชาโท') {
                        $groupedPassedSubjects[$typeId] = $registrations->filter(function ($reg) use ($bestMinorSubmajorId) {
                            $regSubmajorId = $reg->subject->subject_own ? $reg->subject->subject_own->submajor_id : 'none';
                            return $regSubmajorId == $bestMinorSubmajorId;
                        });
                    }
                }
            }

            // Filter passed registrations for 'วิชาชีพบังคับ'
            $passedRegistrations = $passedRegistrations->filter(function ($reg) use ($student) {
                if ($reg->subject && $reg->subject->subject_type && $reg->subject->subject_type->type_name == 'วิชาชีพบังคับ') {
                    return $reg->subject->subject_own && $reg->subject->subject_own->major_id == $student->major_id && $reg->subject->subject_own->submajor_id == $student->submajor_id;
                }
                return true;
            });

            // Also filter 'วิชาชีพเลือก' for groupedPassedSubjects if not allowed
            if (!$isElectiveAllowed) {
                foreach ($groupedPassedSubjects as $typeId => $registrations) {
                    $firstReg = $registrations->first();
                    if ($firstReg && $firstReg->subject && $firstReg->subject->subject_type && $firstReg->subject->subject_type->type_name == 'วิชาชีพเลือก') {
                        $groupedPassedSubjects[$typeId] = $registrations->filter(function ($reg) use ($student) {
                            return $reg->subject && $reg->subject->subject_own && $reg->subject->subject_own->submajor_id == $student->submajor_id;
                        });
                    }
                }
            }

            // Also filter 'วิชาชีพบังคับ' for groupedPassedSubjects
            foreach ($groupedPassedSubjects as $typeId => $registrations) {
                $firstReg = $registrations->first();
                if ($firstReg && $firstReg->subject && $firstReg->subject->subject_type && $firstReg->subject->subject_type->type_name == 'วิชาชีพบังคับ') {
                    $groupedPassedSubjects[$typeId] = $registrations->filter(function ($reg) use ($student) {
                        return $reg->subject && $reg->subject->subject_own && $reg->subject->subject_own->major_id == $student->major_id && $reg->subject->subject_own->submajor_id == $student->submajor_id;
                    });
                }
            }

            foreach ($curriculumType->curriculum_subject as $curriculumSubject) {
                $category = $curriculumSubject->subject_category;
                if ($category) {
                    $totalNeeded += $category->credit_needed;

                    $categoryEarned = $passedRegistrations->filter(function ($reg) use ($category) {
                        return $reg->subject && 
                               $reg->subject->subject_type && 
                               $reg->subject->subject_type->subject_category_id == $category->id;
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

        return view('user.detail', compact('groupedPassedSubjects', 'curriculum_subjects', 'progress', 'isElectiveAllowed', 'isNotInfoSys', 'bestMinorSubmajorName', 'student'));
    }


    public function show($id, $type_id)
    {
        $student = Student::where('user_id', $id)->first();
        $curriculum_id = $student->curriculum_id;
        $subjectType = SubjectType::find($type_id);

        $passedSubjects = StudentRegist::query()->with(['subject.subject_curriculum', 'subject.subject_own'])->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($type_id, $curriculum_id, $subjectType, $student) {
            $query->where('subject_type_id', $type_id)
                  ->whereHas('subject_curriculum', function($q) use ($curriculum_id) {
                      $q->where('curriculum_id', $curriculum_id);
                  });
            if ($subjectType && $subjectType->type_name == 'วิชาชีพบังคับ') {
                $query->whereHas('subject_own', function($q) use ($student) {
                    $q->where('major_id', $student->major_id)
                      ->where('submajor_id', $student->submajor_id);
                });
            }
        })->get();

        $passSubjectId = $passedSubjects->pluck('subject_id')->toArray();

        $unpassedQuery = Subject::query()
            ->with(['subject_curriculum', 'subject_own'])
            ->where('subject_type_id', $type_id)
            ->whereHas('subject_curriculum', function($q) use ($curriculum_id) {
                $q->where('curriculum_id', $curriculum_id);
            })
            ->whereNotIn('id', $passSubjectId);

        if ($subjectType && $subjectType->type_name == 'วิชาชีพบังคับ') {
            $unpassedQuery->whereHas('subject_own', function($q) use ($student) {
                $q->where('major_id', $student->major_id)
                  ->where('submajor_id', $student->submajor_id);
            });
        }

        $unpassedSubjects = $unpassedQuery->get();

        return view('user.show', compact('passedSubjects', 'unpassedSubjects'));
    }

    public function addSubject()
    {
        $user_id  = Auth::user()->id;
        $subject_regist = StudentRegist::where('user_id', $user_id)->pluck('subject_id')->toArray();
        $subjects = Subject::whereNotIn('id', $subject_regist)->get();
        return view('user.add_subject', compact('subjects'));
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'status' => 'required|string',
        ]);

        StudentRegist::create([
            'user_id' => Auth::user()->id,
            'subject_id' => $request->subject_id,
            'status' => $request->status,
        ]);

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
