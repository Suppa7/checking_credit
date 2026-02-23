@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-white border-0 pt-4 text-center">
                    <h4 class="fw-bold text-dark">{{ __('Create Account') }}</h4>
                    <p class="text-muted small">สมัครสมาชิกเพื่อเริ่มต้นใช้งานระบบ</p>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label small fw-bold">Student ID</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                <input id="student_id" type="text" class="form-control bg-light border-start-0 @error('student_id') is-invalid @enderror" name="student_id" value="{{ old('student_id') }}" placeholder="ป้อนรหัสนักศึกษา" required autofocus>
                            </div>
                            @error('student_id')
                                <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label small fw-bold">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control bg-light @error('password') is-invalid @enderror" name="password" placeholder="••••••••" required>
                                @error('password')
                                    <span class="text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password-confirm" class="form-label small fw-bold">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control bg-light" name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-dark btn-lg rounded-3 shadow-sm">
                                {{ __('Register Now') }}
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <span class="text-muted small">มีบัญชีอยู่แล้ว?</span>
                            <a href="{{ route('login') }}" class="text-primary small fw-bold text-decoration-none">เข้าสู่ระบบ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
