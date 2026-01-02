<?php

namespace App\Http\Controllers;

use App\Models\CurriculumSubject;
use App\Models\StudentRegist;
use App\Models\SubjectType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function detail($id)
    {
        $subject_type = SubjectType::query()->whereHas('subject_category.curriculum_subject.curriculum.student.user', function($query) use($id) {
            $query->where('id',$id);
        })->pluck('id');
        $groupedPassedSubjects = StudentRegist::query()->with('subject')->where('user_id',$id)->where('status','Pass')->whereHas('subject',function($query) use($subject_type){
            $query->whereIn('subject_type_id',$subject_type);
        })->get()->groupBy('subject.subject_type_id');
        return view('detail',compact('groupedPassedSubjects'));
    }
}
