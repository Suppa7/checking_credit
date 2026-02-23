@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    /* ปรับแต่ง Table ให้ดูทันสมัย */
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table thead th {
        border: none;
        background-color: #4834d4 !important;
        color: white;
        padding: 15px;
        font-weight: 500;
    }
    .table tbody tr {
        background-color: white;
        transition: transform 0.2s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .table tbody tr:hover {
        transform: scale(1.01);
    }
    .table td {
        vertical-align: middle;
        padding: 15px;
        border: none;
    }
    .category-row {
        background-color: #f8f9fa !important;
        border-left: 5px solid #667eea !important;
    }
    .progress {
        height: 8px;
        border-radius: 10px;
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center text-white">
        <div>
            <h3 class="fw-bold mb-0">รายละเอียดหน่วยกิต</h3>
            <p class="opacity-75 small">ตรวจสอบความคืบหน้าของรายวิชาตามโครงสร้างหลักสูตร</p>
        </div>
        <a href="{{ route('user.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold">
            <i class="bi bi-plus-circle-fill me-2 text-primary"></i>เพิ่มรายวิชา
        </a>
    </div>

    <div class="card glass-card shadow-lg border-0">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center rounded-3">
                        <tr>
                            <th class="rounded-start">ลำดับ</th>
                            <th>หมวดหมู่วิชา / กลุ่มวิชา</th>
                            <th>สถานะ</th>
                            <th>กำหนด</th>
                            <th>ได้แล้ว</th>
                            <th class="rounded-end">ตรวจสอบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->student->curriculum->curriculum_subject as $items)
                            <tr class="category-row">
                                <td colspan="3" class="fw-bold text-primary">
                                    <i class="bi bi-collection-fill me-2"></i>{{ $items->subject_category->category_name }}
                                </td>
                                <td class="text-center fw-bold text-primary">{{ $items->subject_category->credit_needed }}</td>
                                <td colspan="2"></td>
                            </tr>

                            @foreach($items->subject_category->subject_type as $item)
                                @php
                                    $myPassed = $groupedPassedSubjects->get($item->id, collect());
                                    $totalEarned = $myPassed->sum(fn($regist) => $regist->subject->subject_credit);
                                    $isComplete = $totalEarned >= $item->credit_needed;
                                    // คำนวณ % สำหรับ Progress Bar
                                    $percent = ($item->credit_needed > 0) ? min(($totalEarned / $item->credit_needed) * 100, 100) : 0;
                                @endphp
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->type_name }}</div>
                                        <div class="progress mt-2" style="width: 150px;">
                                            <div class="progress-bar {{ $isComplete ? 'bg-success' : 'bg-warning' }}" 
                                                 role="progressbar" style="width: {{ $percent }}%"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if($isComplete)
                                            <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3">
                                                <i class="bi bi-check-circle-fill me-1"></i>ครบแล้ว
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-light text-muted border px-3">ยังไม่ครบ</span>
                                        @endif
                                    </td>
                                    <td class="text-center fw-medium">{{ $item->credit_needed }}</td>
                                    <td class="text-center">
                                        <span class="fs-5 fw-bold {{ $isComplete ? 'text-success' : 'text-danger' }}">
                                            {{ $totalEarned }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.show',['id'=> Auth::user()->id,'type_id'=>$item->id]) }}" 
                                           class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            <i class="bi bi-search me-1"></i> ดูวิชา
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection