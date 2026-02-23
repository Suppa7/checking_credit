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
            <div class="card glass-card shadow-2xl rounded-5 overflow-hidden">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <div class="bg-primary d-inline-block p-3 rounded-circle mb-3 shadow">
                             <i class="bi bi-shield-lock-fill text-white fs-3"></i>
                        </div>
                        <h2 class="fw-black text-dark m-0">Welcome Back</h2>
                        <p class="text-muted">เข้าสู่ระบบจัดการนักศึกษา</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control border-0 bg-light @error('student_id') is-invalid @enderror" id="student_id" name="student_id" placeholder="65000000" value="{{ old('student_id') }}" required>
                            <label for="student_id">Student ID</label>
                            @error('student_id')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control border-0 bg-light @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label small" for="remember">จดจำฉันไว้</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="small text-decoration-none">ลืมรหัสผ่าน?</a>
                        </div>

                        <button type="submit" class="btn btn-gradient btn-lg w-100 rounded-pill shadow-sm">
                            LOGIN
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
