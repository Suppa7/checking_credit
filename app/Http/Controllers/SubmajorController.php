<?php

namespace App\Http\Controllers;

use App\Models\Submajor;
use App\Models\Major;
use Illuminate\Http\Request;

class SubmajorController extends Controller
{
    public function index()
    {
        $submajors = Submajor::with('major')->get();
        return view('admin.submajors.index', compact('submajors'));
    }

    public function create()
    {
        $majors = Major::all();
        return view('admin.submajors.create', compact('majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'submajor_id' => 'required|string|max:255|unique:submajors',
            'submajor_name_thai' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
        ]);

        Submajor::create($request->all());

        return redirect()->route('admin.submajors.index')->with('success', 'เพิ่มข้อมูลวิชาเอกสำเร็จ');
    }

    public function show(Submajor $submajor)
    {
        //
    }

    public function edit(Submajor $submajor)
    {
        $majors = Major::all();
        return view('admin.submajors.edit', compact('submajor', 'majors'));
    }

    public function update(Request $request, Submajor $submajor)
    {
        $request->validate([
            'submajor_id' => 'required|string|max:255|unique:submajors,submajor_id,' . $submajor->id,
            'submajor_name_thai' => 'required|string|max:255',
            'major_id' => 'required|exists:majors,id',
        ]);

        $submajor->update($request->all());

        return redirect()->route('admin.submajors.index')->with('success', 'แก้ไขข้อมูลวิชาเอกสำเร็จ');
    }

    public function destroy(Submajor $submajor)
    {
        $submajor->delete();

        return redirect()->route('admin.submajors.index')->with('success', 'ลบข้อมูลวิชาเอกสำเร็จ');
    }
}
