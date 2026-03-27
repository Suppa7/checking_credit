<?php

namespace App\Http\Controllers;

use App\Models\CurriculumSubject;
use App\Models\Curriculum;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class CurriculumSubjectController extends Controller
{
    public function index()
    {
        $curriculum_subjects = CurriculumSubject::with(['curriculum_type', 'subject_category'])->get();
        return view('admin.curriculum_subjects.index', compact('curriculum_subjects'));
    }

    public function create()
    {
        $curriculums = Curriculum::all();
        $categories = SubjectCategory::all();
        return view('admin.curriculum_subjects.create', compact('curriculums', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'subject_category_id' => 'required|exists:subject_categories,id',
        ]);

        CurriculumSubject::create($request->all());

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'เพิ่มข้อมูลวิชาในหลักสูตรสำเร็จ');
    }

    public function show(CurriculumSubject $curriculum_subject)
    {
        //
    }

    public function edit(CurriculumSubject $curriculum_subject)
    {
        $curriculums = Curriculum::all();
        $categories = SubjectCategory::all();
        return view('admin.curriculum_subjects.edit', compact('curriculum_subject', 'curriculums', 'categories'));
    }

    public function update(Request $request, CurriculumSubject $curriculum_subject)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'subject_category_id' => 'required|exists:subject_categories,id',
        ]);

        $curriculum_subject->update($request->all());

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'แก้ไขข้อมูลวิชาในหลักสูตรสำเร็จ');
    }

    public function destroy(CurriculumSubject $curriculum_subject)
    {
        $curriculum_subject->delete();

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'ลบข้อมูลวิชาในหลักสูตรสำเร็จ');
    }
}
