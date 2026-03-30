@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">เมนูจัดการข้อมูล</li>
@endsection

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
    .btn-all-subjects {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
                                    <div class="info-value">{{ Auth::user()->student->curriculum->major->major_name_thai }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="student-info-box">
                                    <div class="info-label">วิชาเอก</div>
                                    <div class="info-value">{{ Auth::user()->student->submajor->submajor_name_thai ?? '-' }}</div>
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

                    <!-- Curriculum Progress Section -->
                    <div class="mb-5">
                        <h5 class="fw-bold text-dark mb-4">
                            <i class="bi bi-bar-chart-steps text-primary me-2"></i>สรุปความคืบหน้าหลักสูตร
                        </h5>
                        <div class="row g-4">
                            @forelse($curriculumTypes as $type)
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm rounded-4 h-100" style="background: #f8f9fa; transition: transform 0.2s;">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="fw-bold text-dark mb-1">{{ $type->type_name }}</h6>
                                                <small class="text-muted">ความคืบหน้ารวม</small>
                                            </div>
                                            <span class="badge bg-primary rounded-pill">{{ $type->progress_percentage }}%</span>
                                        </div>
                                        
                                        <div class="progress mb-3" style="height: 10px; border-radius: 5px; background-color: #e9ecef;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                 role="progressbar" 
                                                 style="width: {{ $type->progress_percentage }}%; border-radius: 5px; background: linear-gradient(90deg, #2a5298, #1e3c72);" 
                                                 aria-valuenow="{{ $type->progress_percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-dark small">
                                                <span class="fw-bold">{{ $type->total_earned }}</span> 
                                                <span class="text-muted">/ {{ $type->total_needed }} หน่วยกิต</span>
                                            </div>
                                            <form action="{{ route('user.detail', ['id' => Auth::user()->id]) }}" method="GET">
                                                <input type="hidden" name="type_name" value="{{ $type->type_name }}">
                                                <button type="submit" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                    ดูรายละเอียด
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-light">
                                    <div class="mb-3 text-warning">
                                        <i class="bi bi-exclamation-triangle-fill" style="font-size: 3rem;"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark">ไม่พบรูปแบบหลักสูตรที่ตรงกับวิชาเอกของคุณ</h5>
                                    <p class="text-muted small mb-0">โปรดติดต่อผู้ดูแลระบบเพื่อตรวจสอบข้อมูลหลักสูตรของคุณ</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Menu Section -->
                    <h5 class="fw-bold text-center text-dark mb-4">เมนูการจัดการ</h5>

                    <div class="d-grid gap-3 col-md-10 mx-auto">
                        <button type="button" class="btn btn-credits btn-lg menu-btn py-3" data-bs-toggle="modal" data-bs-target="#checkCreditsModal">
                            <i class="bi bi-card-checklist me-2"></i> เช็กหน่วยกิต (Check Credits)
                        </button>
                        
                        <a href="{{ route('user.add_subject') }}" class="btn btn-add btn-lg menu-btn py-3 text-white">
                            <i class="bi bi-journal-plus me-2"></i> เพิ่มวิชาที่ลงทะเบียน (Add Subject)
                        </a>
                        
                        <a href="{{ route('user.registrations') }}" class="btn btn-all-subjects btn-lg menu-btn py-3 text-white">
                            <i class="bi bi-journal-text me-2"></i> รายวิชาที่ลงทะเบียนทั้งหมด (All Registered Subjects)
                        </a>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal for selecting Curriculum Type -->
<div class="modal fade" id="checkCreditsModal" tabindex="-1" aria-labelledby="checkCreditsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-light border-0 rounded-top-4">
                <h5 class="modal-title fw-bold text-dark" id="checkCreditsModalLabel">
                    <i class="bi bi-funnel-fill text-primary me-2"></i>เลือกรูปแบบหลักสูตร
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.detail', ['id' => Auth::user()->id]) }}" method="GET">
                <div class="modal-body p-4 text-dark">
                    <p class="text-muted mb-3">กรุณาเลือกรูปแบบหลักสูตรที่ต้องการตรวจสอบโครงสร้างหน่วยกิต</p>
                    <div class="mb-3">
                        <label for="type_name" class="form-label fw-bold">รูปแบบหลักสูตร (Curriculum Type)</label>
                        <select name="type_name" id="type_name" class="form-select form-select-lg rounded-3 shadow-sm border-0 bg-light" required>
                            @if(isset($curriculumTypes) && $curriculumTypes->count() > 0)
                                @foreach($curriculumTypes as $type)
                                    <option value="{{ $type->type_name }}">{{ $type->type_name }}</option>
                                @endforeach
                            @else
                                <option value="" disabled>-- ไม่พบรูปแบบหลักสูตร --</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-check2-circle me-1"></i> ยืนยัน
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 when the modal is shown
        $('#checkCreditsModal').on('shown.bs.modal', function () {
            $('#type_name').select2({
                dropdownParent: $('#checkCreditsModal'), // Fix dropdown z-index inside modal
                width: '100%',
                placeholder: 'เลือกรูปแบบหลักสูตร',
                allowClear: true
            });
        });
    });
</script>
@endsection