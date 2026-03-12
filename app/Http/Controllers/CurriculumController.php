<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::all();
        return view('admin.curriculums.index', compact('curriculums'));
    }

    public function create()
    {
        return view('admin.curriculums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_name' => 'required|string|max:255',
            'curriculum_name' => 'required|string|max:255',
            'curriculum_year' => 'required|string|max:4',
        ]);

        Curriculum::create($request->all());

        return redirect()->route('admin.curriculums.index')->with('success', 'เพิ่มข้อมูลเล่มหลักสูตรสำเร็จ');
    }

    public function show(Curriculum $curriculum)
    {
        //
    }

    public function edit(Curriculum $curriculum)
    {
        return view('admin.curriculums.edit', compact('curriculum'));
    }

    public function update(Request $request, Curriculum $curriculum)
    {
        $request->validate([
            'program_name' => 'required|string|max:255',
            'curriculum_name' => 'required|string|max:255',
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
