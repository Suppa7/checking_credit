<?php

namespace App\Http\Controllers;

use App\Models\SubjectType;
use App\Models\SubjectCategory;
use Illuminate\Http\Request;

class SubjectTypeController extends Controller
{
    public function index()
    {
        $subject_types = SubjectType::with('subject_category')->get();
        return view('admin.subject_types.index', compact('subject_types'));
    }

    public function create()
    {
        $categories = SubjectCategory::all();
        return view('admin.subject_types.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_category_id' => 'required|exists:subject_categories,id',
            'type_name' => 'required|string|max:255',
            'credit_needed' => 'required|integer|min:0',
        ]);

        SubjectType::create($request->all());

        return redirect()->route('admin.subject_types.index')->with('success', 'เพิ่มข้อมูลหมวดวิชาสำเร็จ');
    }

    public function show(SubjectType $subject_type)
    {
        //
    }

    public function edit(SubjectType $subject_type)
    {
        $categories = SubjectCategory::all();
        return view('admin.subject_types.edit', compact('subject_type', 'categories'));
    }

    public function update(Request $request, SubjectType $subject_type)
    {
        $request->validate([
            'subject_category_id' => 'required|exists:subject_categories,id',
            'type_name' => 'required|string|max:255',
            'credit_needed' => 'required|integer|min:0',
        ]);

        $subject_type->update($request->all());

        return redirect()->route('admin.subject_types.index')->with('success', 'แก้ไขข้อมูลหมวดวิชาสำเร็จ');
    }

    public function destroy(SubjectType $subject_type)
    {
        $subject_type->delete();

        return redirect()->route('admin.subject_types.index')->with('success', 'ลบข้อมูลหมวดวิชาสำเร็จ');
    }
}
