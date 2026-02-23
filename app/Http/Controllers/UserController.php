<?php

namespace App\Http\Controllers;

use App\Models\StudentRegist;
use App\Models\Subject;
use App\Models\SubjectType;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }
    
    public function detail($id)
    {
        $subject_type = SubjectType::query()->whereHas('subject_category.curriculum_subject.curriculum.student.user', function($query) use($id) {
            $query->where('id',$id);
        })->pluck('id');
        $groupedPassedSubjects = StudentRegist::query()->with('subject')->where('user_id',$id)->where('status','Pass')->whereHas('subject',function($query) use($subject_type){
            $query->whereIn('subject_type_id',$subject_type);
        })->get()->groupBy('subject.subject_type_id');
        return view('user.detail', compact('groupedPassedSubjects'));
    }

    public function show($id,$type_id)
    {
        $passedSubjects = StudentRegist::query()->with('subject')->where('user_id',$id)->where('status','Pass')->whereHas('subject',function($query) use($type_id){
            $query->where('subject_type_id',$type_id);
        })->get();
        $passSubjectId = $passedSubjects->pluck('subject_id')->toArray();
        $unpassedSubjects = Subject::query()->where('subject_type_id',$type_id)->whereNotIn('id', $passSubjectId)->get();
        return view('user.show', compact('passedSubjects','unpassedSubjects'));
    }
}
