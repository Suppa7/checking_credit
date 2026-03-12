<?php

namespace App\Http\Controllers;

use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class SubjectCategoryController extends Controller
{
    public function index()
    {
        $subject_categories = SubjectCategory::all();
        return view('admin.subject_categories.index', compact('subject_categories'));
    }

    public function create()
    {
        return view('admin.subject_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'credit_needed' => 'required|integer|min:0',
        ]);

        SubjectCategory::create($request->all());

        return redirect()->route('admin.subject_categories.index')->with('success', 'เพิ่มข้อมูลกลุ่มวิชาสำเร็จ');
    }

    public function show(SubjectCategory $subject_category)
    {
        //
    }

    public function edit(SubjectCategory $subject_category)
    {
        return view('admin.subject_categories.edit', compact('subject_category'));
    }

    public function update(Request $request, SubjectCategory $subject_category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'credit_needed' => 'required|integer|min:0',
        ]);

        $subject_category->update($request->all());

        return redirect()->route('admin.subject_categories.index')->with('success', 'แก้ไขข้อมูลกลุ่มวิชาสำเร็จ');
    }

    public function destroy(SubjectCategory $subject_category)
    {
        $subject_category->delete();

        return redirect()->route('admin.subject_categories.index')->with('success', 'ลบข้อมูลกลุ่มวิชาสำเร็จ');
    }
}
