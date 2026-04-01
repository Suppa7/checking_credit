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
                             <i class="bi bi-lock-fill text-white fs-3"></i>
                        </div>
                        <h2 class="fw-black text-dark m-0">ตั้งรหัสผ่านใหม่</h2>
                        <p class="text-muted">กรุณาตั้งรหัสผ่านใหม่ของคุณ (อย่างน้อย 8 ตัวอักษร)</p>
                    </div>

                    <form method="POST" action="{{ route('custom.password.update') }}">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control border-0 bg-light @error('password') is-invalid @enderror" id="password" name="password" placeholder="New Password" required minlength="8" autofocus>
                            <label for="password">New Password</label>
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control border-0 bg-light" id="password-confirm" name="password_confirmation" placeholder="Confirm New Password" required minlength="8">
                            <label for="password-confirm">Confirm New Password</label>
                        </div>

                        <button type="submit" class="btn btn-gradient btn-lg w-100 rounded-pill shadow-sm mb-3">
                            {{ __('ยืนยันรหัสผ่านใหม่') }}
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('custom.password.request') }}" class="text-primary small fw-bold text-decoration-none">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
