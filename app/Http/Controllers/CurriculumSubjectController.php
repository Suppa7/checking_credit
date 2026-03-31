<?php

namespace App\Http\Controllers;

use App\Models\CurriculumSubject;
use App\Models\CurriculumType;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class CurriculumSubjectController extends Controller
{
    public function index()
    {
        $curriculum_subjects = CurriculumSubject::with(['curriculum_type.curriculum.major', 'curriculum_type.submajor', 'subject_category'])
            ->get()
            ->groupBy('curriculum_type_id');
        return view('admin.curriculum_subjects.index', compact('curriculum_subjects'));
    }

    public function create()
    {
        $curriculum_types = CurriculumType::with(['curriculum.major', 'submajor'])->get();
        $categories = SubjectCategory::all();
        return view('admin.curriculum_subjects.create', compact('curriculum_types', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curriculum_type_id' => 'required|exists:curriculum_types,id',
            'subject_category_ids' => 'required|array',
            'subject_category_ids.*' => 'exists:subject_categories,id',
        ]);

        foreach ($request->subject_category_ids as $category_id) {
            CurriculumSubject::firstOrCreate([
                'curriculum_type_id' => $request->curriculum_type_id,
                'subject_category_id' => $category_id,
            ]);
        }

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'เพิ่มข้อมูลวิชาในหลักสูตรสำเร็จ');
    }

    public function show(CurriculumSubject $curriculum_subject)
    {
        //
    }

    public function edit(CurriculumSubject $curriculum_subject)
    {
        $curriculum_types = CurriculumType::with(['curriculum.major', 'submajor'])->get();
        $categories = SubjectCategory::all();
        
        // Get all selected categories for this curriculum type
        $selected_categories = CurriculumSubject::where('curriculum_type_id', $curriculum_subject->curriculum_type_id)
            ->pluck('subject_category_id')
            ->toArray();

        return view('admin.curriculum_subjects.edit', compact('curriculum_subject', 'curriculum_types', 'categories', 'selected_categories'));
    }

    public function update(Request $request, CurriculumSubject $curriculum_subject)
    {
        $request->validate([
            'curriculum_type_id' => 'required|exists:curriculum_types,id',
            'subject_category_ids' => 'required|array',
            'subject_category_ids.*' => 'exists:subject_categories,id',
        ]);

        // Sync logic: Delete existing for this type and recreate
        CurriculumSubject::where('curriculum_type_id', $curriculum_subject->curriculum_type_id)->delete();

        foreach ($request->subject_category_ids as $category_id) {
            CurriculumSubject::create([
                'curriculum_type_id' => $request->curriculum_type_id,
                'subject_category_id' => $category_id,
            ]);
        }

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'แก้ไขข้อมูลวิชาในหลักสูตรสำเร็จ');
    }

    public function destroy(CurriculumSubject $curriculum_subject)
    {
        $curriculum_subject->delete();

        return redirect()->route('admin.curriculum_subjects.index')->with('success', 'ลบข้อมูลวิชาในหลักสูตรสำเร็จ');
    }
}
