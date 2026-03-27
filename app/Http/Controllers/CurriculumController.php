<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::with('major')->get();
        return view('admin.curriculums.index', compact('curriculums'));
    }

    public function create()
    {
        $majors = \App\Models\Major::all();
        return view('admin.curriculums.create', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'curriculum_year' => 'required|string|max:4',
        ]);

        Curriculum::create($request->all());

        return redirect()->route('admin.curriculums.index')->with('success', 'เพิ่มข้อมูลเล่มหลักสูตรสำเร็จ');
    }

    public function show(Curriculum $curriculum)
    {
        $curriculum->load([
            'major',
            'curriculum_type',
            'subject_curriculum.subject.subject_type.subject_category'
        ]);

        return view('admin.curriculums.show', compact('curriculum'));
    }

    public function edit(Curriculum $curriculum)
    {
        $majors = \App\Models\Major::all();
        return view('admin.curriculums.edit', compact('curriculum', 'majors'));
    }

    public function update(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'major_id' => 'required|exists:majors,id',
            'curriculum_year' => 'required|string|max:4',
        ]);

        $curriculum->update($request->all());

        return redirect()->route('admin.curriculums.index')->with('success', 'แก้ไขข้อมูลเล่มหลักสูตรสำเร็จ');
    }

    public function destroy(Curriculum $curriculum)

    {
        $curriculum->delete();

        return redirect()->route('admin.curriculums.index')->with('success', 'ลบข้อมูลเล่มหลักสูตรสำเร็จ');
    }
}




