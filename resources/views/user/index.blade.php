@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        color: #fff;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #333; /* ตัวหนังสือในการ์ดเป็นสีเข้มเพื่อให้อ่านง่าย */
    }
    .btn-gradient-success {
        background: linear-gradient(to right, #00b09b, #96c93d);
        border: none;
        color: white;
        transition: 0.3s;
    }
    .btn-gradient-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        color: white;
    }
    .info-label {
        color: #667eea;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .info-value {
        font-weight: 700;
        color: #2d3436;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="text-center mb-4">
                <h2 class="fw-bold text-white">ตรวจสอบข้อมูล</h2>
                <div class="mx-auto bg-white opacity-25" style="height: 3px; width: 60px; border-radius: 2px;"></div>
            </div>

            <div class="card glass-card border-0 shadow-lg rounded-5">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="text-center mb-5 pb-4 border-bottom">
                        <div class="mb-3">
                            <i class="bi bi-person-circle text-primary" style="font-size: 4rem;"></i>
                        </div>
                        <h6 class="info-label mb-1">Student ID</h6>
                        <h3 class="fw-black text-dark">{{ Auth::user()->student_id }}</h3>
                    </div>

                    <div class="row g-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-vcard fs-4 me-3 text-muted"></i>
                                <div>
                                    <div class="info-label">ชื่อ-นามสกุล</div>
                                    <div class="info-value fs-5">{{ Auth::user()->student->student_name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book fs-4 me-3 text-muted"></i>
                                <div>
                                    <div class="info-label">หลักสูตร</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->program_name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-mortarboard fs-4 me-3 text-muted"></i>
                                <div>
                                    <div class="info-label">วิชาเอก</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->curriculum_name }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar3 fs-4 me-3 text-muted"></i>
                                <div>
                                    <div class="info-label">ปีหลักสูตร</div>
                                    <div class="info-value">{{ Auth::user()->student->curriculum->curriculum_year }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('user.detail',['id'=> Auth::user()->id]) }}" 
                   class="btn btn-gradient-success btn-lg px-5 rounded-pill shadow shadow-lg py-3 fw-bold">
                    <i class="bi bi-clipboard2-check me-2"></i> กดเพื่อเช็กหน่วยกิต
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
  