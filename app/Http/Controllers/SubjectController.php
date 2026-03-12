<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\SubjectOwn;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['subject_type', 'subject_own.major', 'subject_own.submajor'])->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $subject_types = SubjectType::all();
        $subject_owns = SubjectOwn::with(['major', 'submajor'])->get();
        return view('admin.subjects.create', compact('subject_types', 'subject_owns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255|unique:subjects',
            'subject_name' => 'required|string|max:255',
            'subject_credit' => 'required|string|max:255',
            'subject_type_id' => 'required|exists:subject_types,id',
            'subject_own_id' => 'nullable|exists:subject_owns,id',
        ]);

        Subject::create($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'เพิ่มข้อมูลรายวิชาสำเร็จ');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        $subject_types = SubjectType::all();
        $subject_owns = SubjectOwn::with(['major', 'submajor'])->get();
        return view('admin.subjects.edit', compact('subject', 'subject_types', 'subject_owns'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255|unique:subjects,subject_code,' . $subject->id,
            'subject_name' => 'required|string|max:255',
            'subject_credit' => 'required|string|max:255',
            'subject_type_id' => 'required|exists:subject_types,id',
            'subject_own_id' => 'nullable|exists:subject_owns,id',
        ]);

        $subject->update($request->all());

        return redirect()->route('admin.subjects.index')->with('success', 'แก้ไขข้อมูลรายวิชาสำเร็จ');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'ลบข้อมูลรายวิชาสำเร็จ');
    }
}
