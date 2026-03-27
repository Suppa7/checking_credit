<?php

namespace App\Http\Controllers;

use App\Models\CurriculumType;
use App\Models\Curriculum;
use App\Models\Major;
use App\Models\Submajor;
use App\Models\SubmajorMeasure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumTypeController extends Controller
{
    public function index()
    {
        $curriculum_types = CurriculumType::with(['curriculum', 'submajor', 'submajor_measure'])->get();
        return view('admin.curriculum_types.index', compact('curriculum_types'));
    }

    public function create()
    {
        $curriculums = Curriculum::all();
        $majors = Major::with('submajors')->get();
        return view('admin.curriculum_types.create', compact('curriculums', 'majors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'submajor_id' => 'required|exists:submajors,id',
            'type_name' => 'required|string|max:255',
            'submajor_measures' => 'required|array',
        ]);

        DB::transaction(function() use ($request) {
            $curriculumType = CurriculumType::create($request->only(['curriculum_id', 'submajor_id', 'type_name']));

            foreach ($request->submajor_measures as $submajor_id => $type) {
                SubmajorMeasure::create([
                    'curriculum_type_id' => $curriculumType->id,
                    'submajor_id' => $submajor_id,
                    'type' => $type,
                ]);
            }
        });

        return redirect()->route('admin.curriculum_types.index')->with('success', 'เพิ่มรูปแบบหลักสูตรสำเร็จ');
    }

    public function edit(CurriculumType $curriculumType)
    {
        $curriculums = Curriculum::all();
        $majors = Major::with('submajors')->get();
        $measures = $curriculumType->submajor_measure->pluck('type', 'submajor_id')->toArray();
        return view('admin.curriculum_types.edit', compact('curriculumType', 'curriculums', 'majors', 'measures'));
    }

    public function update(Request $request, CurriculumType $curriculumType)
    {
        $request->validate([
            'curriculum_id' => 'required|exists:curriculums,id',
            'submajor_id' => 'required|exists:submajors,id',
            'type_name' => 'required|string|max:255',
            'submajor_measures' => 'required|array',
        ]);

        DB::transaction(function() use ($request, $curriculumType) {
            $curriculumType->update($request->only(['curriculum_id', 'submajor_id', 'type_name']));

            // Update measures (delete and recreate for simplicity)
            $curriculumType->submajor_measure()->delete();

            foreach ($request->submajor_measures as $submajor_id => $type) {
                SubmajorMeasure::create([
                    'curriculum_type_id' => $curriculumType->id,
                    'submajor_id' => $submajor_id,
                    'type' => $type,
                ]);
            }
        });

        return redirect()->route('admin.curriculum_types.index')->with('success', 'แก้ไขรูปแบบหลักสูตรสำเร็จ');
    }

    public function destroy(CurriculumType $curriculumType)
    {
        $curriculumType->delete();
        return redirect()->route('admin.curriculum_types.index')->with('success', 'ลบรูปแบบหลักสูตรสำเร็จ');
    }
}
