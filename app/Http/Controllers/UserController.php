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
        
        $groupedPassedSubjects = StudentRegist::query()->with('subject')->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($subject_type) {
            $query->whereIn('subject_type_id', $subject_type);
        })->get()->groupBy('subject.subject_type_id');
        
        $student = Student::where('user_id', $id)->first();
        
        $typeName = $request->input('type_name');
        $curriculumType = $student->curriculum->curriculum_type()->with(['curriculum_subject.subject_category'])->where('type_name', $typeName)->first();
        
        if (!$curriculumType) {
            $curriculumType = $student->curriculum->curriculum_type()->with(['curriculum_subject.subject_category'])->first();
        }
        
        // Calculate overall progress for this curriculum type
        $totalNeeded = 0;
        $totalEarned = 0;
        
        if ($curriculumType) {
            $passedRegistrations = StudentRegist::where('user_id', $id)
                ->where('status', 'Pass')
                ->with('subject.subject_type')
                ->get();

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
        
        return view('user.detail', compact('groupedPassedSubjects', 'curriculum_subjects', 'progress'));
    }


    public function show($id, $type_id)
    {
        $passedSubjects = StudentRegist::query()->with('subject')->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($type_id) {
            $query->where('subject_type_id', $type_id);
        })->get();
        $passSubjectId = $passedSubjects->pluck('subject_id')->toArray();
        $unpassedSubjects = Subject::query()->where('subject_type_id', $type_id)->whereNotIn('id', $passSubjectId)->get();
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
