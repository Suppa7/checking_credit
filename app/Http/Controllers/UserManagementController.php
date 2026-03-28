<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Curriculum;
use App\Models\Major;
use App\Models\Submajor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->with(['student.curriculum', 'student.major', 'student.submajor'])->paginate(10);
        return view('admin.user_managements.index', compact('users'));
    }

    public function create()
    {
        $curriculums = Curriculum::all();
        $majors = Major::all();
        $submajors = Submajor::all();
        return view('admin.user_managements.create', compact('curriculums', 'majors', 'submajors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user',
            'student_name' => 'required_if:role,user|nullable|string|max:255',
            'curriculum_id' => 'required_if:role,user|nullable|exists:curriculums,id',
            'major_id' => 'required_if:role,user|nullable|exists:majors,id',
            'submajor_id' => 'nullable|exists:submajors,id',
        ]);

        if(User::where('student_id', $request->student_id)->exists()) {
            return redirect()->back()->with('error', 'Student ID already exists');
        }

        if(Student::where('student_name', $request->student_name)->exists()) {
            return redirect()->back()->with('error', 'Student Name already exists');
        }   
        
        $user = User::create([
            'student_id' => $request->student_id,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role == 'user') {
            Student::create([
                'user_id' => $user->id,
                'student_name' => $request->student_name,
                'curriculum_id' => $request->curriculum_id,
                'major_id' => $request->major_id,
                'submajor_id' => $request->submajor_id,
            ]);
        }

        return redirect()->route('admin.user_managements.index')->with('success', 'เพิ่มผู้ใช้และข้อมูลนักศึกษาสำเร็จ');
    }

    public function edit(User $user)
    {
        $user->load('student');
        $curriculums = Curriculum::all();
        $majors = Major::all();
        $submajors = Submajor::all();
        return view('admin.user_managements.edit', compact('user', 'curriculums', 'majors', 'submajors'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'student_id' => 'required|string|max:255|unique:users,student_id,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:admin,user',
            'student_name' => 'required_if:role,user|nullable|string|max:255',
            'curriculum_id' => 'required_if:role,user|nullable|exists:curriculums,id',
            'major_id' => 'required_if:role,user|nullable|exists:majors,id',
            'submajor_id' => 'nullable|exists:submajors,id',
        ]);

        $userData = [
            'student_id' => $request->student_id,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        if ($request->role == 'user') {
            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'student_name' => $request->student_name,
                    'curriculum_id' => $request->curriculum_id,
                    'major_id' => $request->major_id,
                    'submajor_id' => $request->submajor_id,
                ]
            );
        }

        return redirect()->route('admin.user_managements.index')->with('success', 'แก้ไขผู้ใช้และข้อมูลนักศึกษาสำเร็จ');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user_managements.index')->with('success', 'ลบผู้ใช้สำเร็จ');
    }
}
