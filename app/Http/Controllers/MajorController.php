<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('admin.majors.index', compact('majors'));
    }

    public function create()
    {
        return view('admin.majors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'major_id' => 'required|string|max:255|unique:majors',
            'major_name_thai' => 'required|string|max:255',
        ]);

        Major::create($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'เพิ่มข้อมูลหลักสูตรสำเร็จ');
    }

    public function show(Major $major)
    {
        //
    }

    public function edit(Major $major)
    {
        return view('admin.majors.edit', compact('major'));
    }

    public function update(Request $request, Major $major)
    {
        $request->validate([
            'major_id' => 'required|string|max:255|unique:majors,major_id,' . $major->id,
            'major_name_thai' => 'required|string|max:255',
        ]);

        $major->update($request->all());

        return redirect()->route('admin.majors.index')->with('success', 'แก้ไขข้อมูลหลักสูตรสำเร็จ');
    }

    public function destroy(Major $major)
    {
        $major->delete();

        return redirect()->route('admin.majors.index')->with('success', 'ลบข้อมูลหลักสูตรสำเร็จ');
    }
}
