@extends('layouts.app')

@section('content')
    <style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        color: #fff;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    /* ปรับแต่งหัวตารางแยกตามสถานะ */
    .table-passed thead th {
        background-color: #00b894 !important; /* เขียว */
        color: white;
        border: none;
    }

    .table-unpassed thead th {
        background-color: #fdcb6e !important; /* ส้ม/เหลือง */
        color: #2d3436;
        border: none;
    }

    .table tbody tr {
        transition: 0.2s;
    }

    .table tbody tr:hover {
        background-color: rgba(102, 126, 234, 0.05);
    }

    .badge-status {
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 50px;
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center text-white">
        <div>
            <h3 class="fw-bold mb-0"><i class="bi bi-journal-check me-2"></i>ตรวจสอบรายวิชา</h3>
            <p class="opacity-75 small">เปรียบเทียบวิชาที่ดำเนินการเสร็จสิ้นแล้วกับวิชาที่คงเหลือ</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-outline-light rounded-pill px-4 shadow-sm fw-bold">
                <i class="bi bi-arrow-left me-2"></i>ย้อนกลับ
            </a>
            <a href="{{ route('user.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold text-primary">
                <i class="bi bi-plus-circle-fill me-2"></i>เพิ่มรายวิชา
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card glass-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-success bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-check-all text-success fs-4"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold mb-0">รายวิชาที่ผ่านแล้ว</h5>
                    </div>

                    @if ($passedSubjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-passed">
                                <thead class="text-center">
                                    <tr>
                                        <th class="rounded-start">รหัสวิชา</th>
                                        <th>ชื่อวิชา</th>
                                        <th class="rounded-end">หน่วยกิต</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($passedSubjects as $subject)
                                        <tr>
                                            <td class="text-center fw-bold text-primary">{{ $subject->subject->subject_code }}</td>
                                            <td>{{ $subject->subject->subject_name }}</td>
                                            <td class="text-center text-dark">{{ $subject->subject->subject_credit }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-folder-x text-muted fs-1"></i>
                            <p class="text-muted mt-2">ยังไม่มีรายวิชาที่ผ่านในหมวดนี้</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card glass-card h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-clock-history text-warning fs-4"></i>
                        </div>
                        <h5 class="card-title text-dark fw-bold mb-0">รายวิชาที่ยังไม่ผ่าน</h5>
                    </div>

                    @if ($unpassedSubjects->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-unpassed">
                                <thead class="text-center">
                                    <tr>
                                        <th class="rounded-start">รหัสวิชา</th>
                                        <th>ชื่อวิชา</th>
                                        <th class="rounded-end">หน่วยกิต</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unpassedSubjects as $subject)
                                        <tr>
                                            <td class="text-center fw-bold text-muted">{{ $subject->subject_code }}</td>
                                            <td>{{ $subject->subject_name }}</td>
                                            <td class="text-center text-dark">{{ $subject->subject_credit }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5 border rounded-4 bg-light bg-opacity-50">
                            <i class="bi bi-emoji-sunglasses text-success fs-1"></i>
                            <h5 class="text-success fw-bold mt-3">ยินดีด้วย!</h5>
                            <p class="text-muted">คุณเรียนครบทุกวิชาในหมวดนี้แล้ว</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
