@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .btn-gradient {
        background: linear-gradient(to right, #667eea, #764ba2);
        border: none;
        color: white;
        transition: 0.3s;
    }
    .btn-gradient:hover {
        opacity: 0.9;
        transform: translateY(-2px);
        color: white;
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card glass-card shadow-lg rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="bg-primary d-inline-block p-3 rounded-circle mb-3 shadow">
                             <i class="bi bi-key-fill text-white fs-3"></i>
                        </div>
                        <h2 class="fw-black text-dark m-0">Reset Password</h2>
                        <p class="text-muted">เปลี่ยนรหัสผ่านโดยยืนยันชื่อและรหัสนักศึกษา</p>
                    </div>

                    <form method="POST" action="{{ route('custom.password.verify') }}">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border-0 bg-light @error('student_id') is-invalid @enderror" id="student_id" name="student_id" placeholder="รหัสนักศึกษา" value="{{ old('student_id') }}" required>
                            <label for="student_id">Student ID</label>
                            @error('student_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control border-0 bg-light @error('student_name') is-invalid @enderror" id="student_name" name="student_name" placeholder="ชื่อ-นามสกุล" value="{{ old('student_name') }}" required>
                            <label for="student_name">Student Name (ชื่อ-นามสกุล)</label>
                            @error('student_name')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient btn-lg w-100 rounded-pill shadow-sm mb-3">
                            {{ __('ตรวจสอบ') }}
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-primary small fw-bold text-decoration-none"><i class="bi bi-arrow-left"></i> กลับไปหน้าเข้าสู่ระบบ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
