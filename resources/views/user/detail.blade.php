@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">ตรวจสอบผลการเรียนตามโครงสร้างหลักสูตร</li>
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
    /* ปรับแต่ง Table ให้ดูทันสมัย */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .table thead th {
        border: none;
        background: linear-gradient(135deg, #2a5298, #1e3c72) !important;
        color: white;
        padding: 18px 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        background-color: white;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }
    .table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.08);
    }
    .table td {
        vertical-align: middle;
        padding: 18px 15px;
        border: none;
    }
    .category-row {
        background-color: #f8f9fa !important;
        border-left: 5px solid #2a5298 !important;
    }
    .progress {
        height: 10px;
        border-radius: 10px;
        background-color: #e9ecef;
    }
    .progress-bar {
        border-radius: 10px;
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center text-white">
        <div>
            <h3 class="fw-bold mb-0">รายละเอียดหน่วยกิต</h3>
            <p class="opacity-75 small">ตรวจสอบความคืบหน้าของรายวิชาตามโครงสร้างหลักสูตร</p>
        </div>
        <a href="{{ route('user.add_subject') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-bold">
            <i class="bi bi-plus-circle-fill me-2 text-primary"></i>เพิ่มรายวิชา
        </a>
    </div>

    @if(isset($progress))
    <div class="card glass-card mb-4 border-0 shadow-lg">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold text-dark mb-1">
                        <i class="bi bi-mortarboard-fill text-primary me-2"></i>{{ $progress['type_name'] }}
                    </h5>
                    <span class="text-muted small">ความคืบหน้าภาพรวมของหลักสูตร</span>
                </div>
                <div class="text-end">
                    <span class="badge bg-primary rounded-pill fs-6 px-3">{{ $progress['percentage'] }}%</span>
                </div>
            </div>
            
            <div class="progress mb-3" style="height: 15px; border-radius: 10px; background-color: #e9ecef;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                     role="progressbar" 
                     style="width: {{ $progress['percentage'] }}%; border-radius: 10px; background: linear-gradient(90deg, #2a5298, #1e3c72);" 
                     aria-valuenow="{{ $progress['percentage'] }}" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-dark">
                    <span class="fw-bold fs-5">{{ $progress['total_earned'] }}</span> 
                    <span class="text-muted">/ {{ $progress['total_needed'] }} หน่วยกิตที่ต้องเก็บ</span>
                </div>
                <div class="text-muted small">
                    @if($progress['percentage'] >= 100)
                        <span class="text-success fw-bold"><i class="bi bi-check-all me-1"></i>สำเร็จครบถ้วน</span>
                    @else
                        <span>ขาดอีก <span class="fw-bold text-danger">{{ max(0, $progress['total_needed'] - $progress['total_earned']) }}</span> หน่วยกิต</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

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
                        @foreach($curriculum_subjects as $items)
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
                                <tr class="bg-white">
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold text-dark d-flex align-items-center">
                                            <span class="me-2 text-primary">#</span> {{ $item->type_name }}
                                            @if($item->type_name == 'วิชาชีพเลือก' && !$isElectiveAllowed)
                                                <span class="badge bg-warning text-dark ms-2" style="font-size: 0.7rem;">เฉพาะวิชาเอกตนเอง</span>
                                            @endif
                                        </div>
                                        <div class="progress mt-2" style="width: 150px; height: 6px;">
                                            <div class="progress-bar {{ $isComplete ? 'bg-success' : 'bg-warning' }}" 
                                                 role="progressbar" style="width: {{ $percent }}%"></div>
                                        </div>
                                        
                                        {{-- คลี่ดูรายวิชาที่อยู่ในกลุ่มนี้ --}}
                                        <div class="mt-3">
                                            <a class="text-decoration-none small text-primary fw-medium" data-bs-toggle="collapse" href="#subjects-{{ $item->id }}" role="button">
                                                <i class="bi bi-chevron-down me-1"></i> รายวิชาในกลุ่ม ({{ $item->subjects->count() }})
                                            </a>
                                            <div class="collapse mt-2" id="subjects-{{ $item->id }}">
                                                <div class="bg-light p-3 rounded-3 border-0">
                                                    <ul class="list-unstyled mb-0 small">
                                                        @foreach($item->subjects as $subject)
                                                            @php 
                                                                $isPassed = $myPassed->pluck('subject_id')->contains($subject->id);
                                                            @endphp
                                                            <li class="d-flex justify-content-between align-items-center py-1 border-bottom border-secondary border-opacity-10 last-child-border-0">
                                                                <span class="{{ $isPassed ? 'text-success' : 'text-muted' }}">
                                                                    <i class="bi {{ $isPassed ? 'bi-check-circle-fill' : 'bi-circle' }} me-2"></i>
                                                                    <span class="font-monospace fw-bold">{{ $subject->subject_code }}</span> {{ $subject->subject_name }}
                                                                </span>
                                                                <span class="badge {{ $isPassed ? 'bg-success' : 'bg-secondary' }} bg-opacity-10 {{ $isPassed ? 'text-success' : 'text-secondary' }} rounded-pill px-2">
                                                                    {{ $subject->subject_credit }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
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