<?php

namespace App\Http\Controllers;

use App\Models\SubjectOwn;
use App\Models\Major;
use App\Models\Submajor;
use Illuminate\Http\Request;

class SubjectOwnController extends Controller
{
    public function index()
    {
        $subject_owns = SubjectOwn::with(['major', 'submajor'])->get();
        return view('admin.subject_owns.index', compact('subject_owns'));
    }

    public function create()
    {
        $majors = Major::all();
        $submajors = Submajor::all();
        return view('admin.subject_owns.create', compact('majors', 'submajors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'submajor_id' => 'nullable|exists:submajors,id',
        ]);

        SubjectOwn::create($request->all());

        return redirect()->route('admin.subject_owns.index')->with('success', 'เพิ่มข้อมูลเจ้าของวิชาสำเร็จ');
    }

    public function show(SubjectOwn $subject_own)
    {
        //
    }

    public function edit(SubjectOwn $subject_own)
    {
        $majors = Major::all();
        $submajors = Submajor::all();
        return view('admin.subject_owns.edit', compact('subject_own', 'majors', 'submajors'));
    }

    public function update(Request $request, SubjectOwn $subject_own)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'submajor_id' => 'nullable|exists:submajors,id',
        ]);

        $subject_own->update($request->all());

        return redirect()->route('admin.subject_owns.index')->with('success', 'แก้ไขข้อมูลเจ้าของวิชาสำเร็จ');
    }

    public function destroy(SubjectOwn $subject_own)
    {
        $subject_own->delete();

        return redirect()->route('admin.subject_owns.index')->with('success', 'ลบข้อมูลเจ้าของวิชาสำเร็จ');
    }
}
