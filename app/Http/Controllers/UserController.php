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
        return view('user.index');
    }

    public function detail($id)
    {
        $subject_type = SubjectType::query()->whereHas('subject_category.curriculum_subject.curriculum.student.user', function ($query) use ($id) {
            $query->where('id', $id);
        })->pluck('id');
        $groupedPassedSubjects = StudentRegist::query()->with('subject')->where('user_id', $id)->where('status', 'Pass')->whereHas('subject', function ($query) use ($subject_type) {
            $query->whereIn('subject_type_id', $subject_type);
        })->get()->groupBy('subject.subject_type_id');
        return view('user.detail', compact('groupedPassedSubjects'));
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
        $subjects = Subject::all();
        return view('user.add_subject', compact('subjects'));
    }

    public function storeSubject(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'status' => 'required|string',
        ]);

        StudentRegist::create([
            'user_id' => Auth::id(),
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
