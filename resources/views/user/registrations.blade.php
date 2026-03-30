@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">เมนูจัดการข้อมูล</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายวิชาที่ลงทะเบียนทั้งหมด</li>
@endsection

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    }
    .table thead th {
        border: none;
        background: linear-gradient(135deg, #2a5298, #1e3c72) !important;
        color: white;
        padding: 18px 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
    }
    .table tbody tr {
        background-color: white;
        transition: transform 0.2s;
    }
    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .status-pass {
        background-color: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid #28a745;
    }
    .status-fail {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid #dc3545;
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center text-white">
        <div>
            <h3 class="fw-bold mb-0">รายวิชาที่ลงทะเบียนทั้งหมด</h3>
            <p class="opacity-75 small">แสดงรายการวิชาทั้งหมดที่คุณได้เคยลงทะเบียนไว้ในระบบ</p>
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold">
            <i class="bi bi-arrow-left me-2"></i>กลับหน้าเมนู
        </a>
    </div>

    <div class="card glass-card shadow-lg border-0">
        <div class="card-header bg-transparent border-0 p-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0">
                <i class="bi bi-journal-text text-primary me-2"></i>รายการวิชา
            </h5>
            <span class="badge bg-primary rounded-pill px-3 py-2 fs-6">
                ทั้งหมด: <span class="fw-bold">{{ count($registrations) }}</span> วิชา
            </span>
        </div>
        <div class="card-body p-4 pt-0">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-center">
                        <tr>
                            <th class="rounded-start">ลำดับ</th>
                            <th>รหัสวิชา</th>
                            <th>ชื่อรายวิชา</th>
                            <th>หน่วยกิต</th>
                            <th class="rounded-end">สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $index => $regist)
                        <tr class="text-center">
                            <td class="text-muted">{{ $index + 1 }}</td>
                            <td><span class="badge bg-light text-dark border px-2 py-1 font-monospace">{{ $regist->subject->subject_code }}</span></td>
                            <td class="text-start">
                                <div class="fw-bold text-dark">{{ $regist->subject->subject_name }}</div>
                                @if($regist->subject->subject_own)
                                <small class="text-muted">
                                    {{ $regist->subject->subject_own->major->major_name_thai ?? '' }} 
                                    {{ $regist->subject->subject_own->submajor ? '/ ' . $regist->subject->subject_own->submajor->submajor_name_thai : '' }}
                                </small>
                                @endif
                            </td>
                            <td class="fw-bold text-primary">{{ $regist->subject->subject_credit }}</td>
                            <td>
                                <span class="status-badge {{ $regist->status == 'Pass' ? 'status-pass' : 'status-fail' }}">
                                    @if($regist->status == 'Pass')
                                        <i class="bi bi-check-circle-fill me-1"></i>ผ่าน (Pass)
                                    @else
                                        <i class="bi bi-x-circle-fill me-1"></i>ไม่ผ่าน (Unpass)
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted italic">
                                <i class="bi bi-inbox-fill d-block mb-3" style="font-size: 3rem; opacity: 0.2;"></i>
                                ไม่พบข้อมูลการลงทะเบียนวิชา
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
