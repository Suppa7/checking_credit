<?php

namespace App\Http\Controllers;

use App\Models\CurriculumType;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumTypeController extends Controller
{
    public function index()
    {
        $curriculum_types = CurriculumType::with('curriculum')->get();
        return view('admin.curriculum_types.index', compact('curriculum_types'));
    }

    public function create()
    {
        $curriculums = Curriculum::all();
        return view('admin.curriculum_types.create', compact('curriculums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'type_name' => 'required|string|max:255',
        ]);

        CurriculumType::create($request->all());

        return redirect()->route('admin.curriculum_types.index')->with('success', 'เพิ่มรูปแบบหลักสูตรสำเร็จ');
    }

    public function edit(CurriculumType $curriculumType)
    {
        $curriculums = Curriculum::all();
        return view('admin.curriculum_types.edit', compact('curriculumType', 'curriculums'));
    }

    public function update(Request $request, CurriculumType $curriculumType)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'type_name' => 'required|string|max:255',
        ]);

        $curriculumType->update($request->all());

        return redirect()->route('admin.curriculum_types.index')->with('success', 'แก้ไขรูปแบบหลักสูตรสำเร็จ');
    }

    public function destroy(CurriculumType $curriculumType)
    {
        $curriculumType->delete();
        return redirect()->route('admin.curriculum_types.index')->with('success', 'ลบรูปแบบหลักสูตรสำเร็จ');
    }
}
