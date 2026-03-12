@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        min-height: 100vh;
        color: #fff;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    .student-info-box {
        background: linear-gradient(to right, #f8f9fa, #e9ecef);
        border-radius: 12px;
        padding: 1.5rem;
        border-left: 5px solid #2a5298;
    }
    .info-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }
    .info-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2b2b2b;
    }
    .menu-btn {
        transition: all 0.3s ease;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .menu-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    .btn-credits {
        background: linear-gradient(135deg, #00b09b, #96c93d);
        border: none;
        color: white;
    }
    .btn-add {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        color: white;
    }
    .btn-edit {
        background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        border: none;
        color: white;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="text-center mb-4 text-white">
                <i class="bi bi-mortarboard-fill" style="font-size: 3rem;"></i>
                <h2 class="fw-bold mt-2">ศูนย์ตรวจสอบข้อมูลนักศึกษา</h2>
                <div class="mx-auto bg-white opacity-50" style="height: 3px; width: 60px; border-radius: 2px;"></div>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card glass-card">
                <div class="card-body p-4 p-md-5">
                    
                    <!-- Student Info Section -->
                    <div class="mb-5 pb-4 border-bottom">
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="bi bi-person-badge text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <h4 class="fw-black text-dark mb-0">{{ Auth::user()->student->student_name }}</h4>
                                <span class="text-muted">รหัสนักศึกษา: <strong>{{ Auth::user()->student_id }}</strong></span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="student-info-box">
                                    <div class="info-label">หลักสูตร</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->program_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="student-info-box">
                                    <div class="info-label">วิชาเอก</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->curriculum_name }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="student-info-box border-left-info" style="border-left-color: #17a2b8;">
                                    <div class="info-label">ปีที่ใช้หลักสูตร</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->curriculum_year }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Section -->
                    <h5 class="fw-bold text-center text-dark mb-4">เมนูการจัดการ</h5>
                    <div class="d-grid gap-3 col-md-10 mx-auto">
                        <a href="{{ route('user.detail', ['id' => Auth::user()->id]) }}" class="btn btn-credits btn-lg menu-btn py-3">
                            <i class="bi bi-card-checklist me-2"></i> เช็กหน่วยกิต (Check Credits)
                        </a>
                        
                        <a href="{{ route('user.add_subject') }}" class="btn btn-add btn-lg menu-btn py-3 text-white">
                            <i class="bi bi-journal-plus me-2"></i> เพิ่มวิชาที่ลงทะเบียน (Add Subject)
                        </a>
                        
                        <a href="{{ route('user.edit_student') }}" class="btn btn-edit btn-lg menu-btn py-3 text-dark">
                            <i class="bi bi-person-gear me-2"></i> แก้ไขข้อมูลนักศึกษา (Edit Info)
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
  