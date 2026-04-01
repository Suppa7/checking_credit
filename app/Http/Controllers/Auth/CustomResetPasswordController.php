<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomResetPasswordController extends Controller
{
    // Step 1: Show form for Student ID and Name
    public function showResetForm()
    {
        return view('auth.custom_reset_password');
    }

    // Step 1: Verify criteria and store in session
    public function verifyStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'student_name' => 'required|string',
        ]);

        $user = User::where('student_id', $request->student_id)->with('student')->first();

        if ($user && $user->student && $user->student->student_name === $request->student_name) {
            session(['reset_student_id' => $user->student_id]);
            return redirect()->route('custom.password.reset_form');
        }

        return back()->withInput($request->only('student_id', 'student_name'))
                     ->withErrors(['student_id' => 'ข้อมูลรหัสนักศึกษา หรือ ชื่อ-นามสกุล ไม่ถูกต้อง']);
    }

    // Step 2: Show form for new password
    public function showNewPasswordForm()
    {
        if (!session()->has('reset_student_id')) {
            return redirect()->route('custom.password.request');
        }

        return view('auth.custom_new_password');
    }

    // Step 2: Update the password in database
    public function reset(Request $request)
    {
        if (!session()->has('reset_student_id')) {
            return redirect()->route('custom.password.request');
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $student_id = session('reset_student_id');
        $user = User::where('student_id', $student_id)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            session()->forget('reset_student_id');

            return redirect()->route('login')->with('status', 'รีเซ็ตรหัสผ่านเรียบร้อยแล้ว กรุณาเข้าสู่ระบบด้วยรหัสผ่านใหม่');
        }

        return redirect()->route('custom.password.request')->withErrors(['student_id' => 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง']);
    }
}
