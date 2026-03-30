<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\SubjectOwn;
use App\Models\Curriculum;
use App\Models\SubjectCurriculum;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with(['subject_type', 'subject_own.major', 'subject_own.submajor', 'curriculums'])->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $subject_types = SubjectType::query()
            ->select('type_name')
            ->groupBy('type_name')
            ->orderByRaw('MIN(id) ASC')
            ->pluck('type_name');
        $subject_owns = SubjectOwn::with(['major', 'submajor'])->get();
        $curriculums = Curriculum::all();
        return view('admin.subjects.create', compact('subject_types', 'subject_owns', 'curriculums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255|unique:subjects',
            'subject_name' => 'required|string|max:255',
            'subject_credit' => 'required|string|max:255',
            'type_name' => 'required|string|max:255',
            'subject_own_id' => 'nullable|exists:subject_owns,id',
            'curriculum_ids' => 'nullable|array',
            'curriculum_ids.*' => 'exists:curriculums,id',
        ]);

        $subject = Subject::create($request->except('curriculum_ids'));

        if ($request->has('curriculum_ids')) {
            foreach ($request->curriculum_ids as $curriculum_id) {
                SubjectCurriculum::create([
                    'subject_id' => $subject->id,
                    'curriculum_id' => $curriculum_id,
                ]);
            }
        }

        return redirect()->route('admin.subjects.index', ['page' => $request->page])->with('success', 'เพิ่มข้อมูลรายวิชาสำเร็จ');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit(Subject $subject)
    {
        $subject->load('curriculums');
        $subject_types = SubjectType::query()
            ->select('type_name')
            ->groupBy('type_name')
            ->orderByRaw('MIN(id) ASC')
            ->pluck('type_name');
        $subject_owns = SubjectOwn::with(['major', 'submajor'])->get();
        $curriculums = Curriculum::all();
        return view('admin.subjects.edit', compact('subject', 'subject_types', 'subject_owns', 'curriculums'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'subject_code' => 'required|string|max:255|unique:subjects,subject_code,' . $subject->id,
            'subject_name' => 'required|string|max:255',
            'subject_credit' => 'required|string|max:255',
            'type_name' => 'required|string|max:255',
            'subject_own_id' => 'nullable|exists:subject_owns,id',
            'curriculum_ids' => 'nullable|array',
            'curriculum_ids.*' => 'exists:curriculums,id',
        ]);

        $subject->update($request->except('curriculum_ids'));
        
        // Remove old associations and add new ones using SubjectCurriculum model
        SubjectCurriculum::where('subject_id', $subject->id)->delete();
        
        if ($request->has('curriculum_ids')) {
            foreach ($request->curriculum_ids as $curriculum_id) {
                SubjectCurriculum::create([
                    'subject_id' => $subject->id,
                    'curriculum_id' => $curriculum_id,
                ]);
            }
        }

        return redirect()->route('admin.subjects.index', ['page' => $request->page])->with('success', 'แก้ไขข้อมูลรายวิชาสำเร็จ');
    }

    public function destroy(Subject $subject)
    {
        $subject->curriculums()->detach();
        $subject->delete();

        return redirect()->back()->with('success', 'ลบข้อมูลรายวิชาสำเร็จ');
    }
}
