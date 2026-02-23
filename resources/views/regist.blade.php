@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">ตรวจสอบผลการเรียนตามโครงสร้างหลักสูตร</h2>

    @php
        // คำนวณภาพรวม (หน่วยกิตทั้งหมดที่ได้ / หน่วยกิตที่ต้องใช้ทั้งหมด)
        // สมมติว่าใน curriculum มี field total_credits_required
        $totalRequired = Auth::user()->student->curriculum->total_credits ?? 0;
        $allEarned = $groupedPassedSubjects->flatten()->sum(function($r) {
            return $r->subject->subject_credit;
        });
        $overallPercent = $totalRequired > 0 ? ($allEarned / $totalRequired) * 100 : 0;
    @endphp

    {{-- 1. ส่วนสรุปภาพรวม (Overall Progress) --}}
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-body bg-light rounded">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="card-title">ความคืบหน้าภาพรวม</h5>
                    <p class="text-muted mb-1">เก็บหน่วยกิตได้แล้ว {{ $allEarned }} จากทั้งหมด {{ $totalRequired }} หน่วยกิต</p>
                </div>
                <div class="col-md-6">
                    <div class="progress" style="height: 25px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
                             role="progressbar" style="width: {{ $overallPercent }}%">
                            {{ number_format($overallPercent, 1) }}%
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. ตารางแสดงรายละเอียด --}}
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle bg-white">
            <thead class="table-dark">
                <tr>
                    <th style="width: 8%">ลำดับ</th>
                    <th style="width: 50%">หมวดหมู่วิชา / รายชื่อวิชา</th>
                    <th style="width: 12%" class="text-center">สถานะ/เกรด</th>
                    <th style="width: 15%" class="text-center">หน่วยกิตที่ต้องใช้</th>
                    <th style="width: 15%" class="text-center">หน่วยกิตที่ได้</th>
                </tr>
            </thead>
            <tbody>
                @foreach(Auth::user()->student->curriculum->curriculum_subject as $items)
                    {{-- แถวหัวข้อหมวดหมู่ใหญ่ (เช่น หมวดวิชาเฉพาะ) --}}
                    <tr class="table-secondary">
                        <td colspan="2" class="fw-bold">
                            <i class="bi bi-folder-fill me-2"></i>{{ $items->subject_category->category_name }}
                        </td>
                        <td></td>
                        <td class="text-center fw-bold">{{ $items->subject_category->credit_needed }}</td>
                        <td></td>
                    </tr>

                    @foreach($items->subject_category->subject_type as $item)
                        @php
                            $myPassed = $groupedPassedSubjects->get($item->id, collect());
                            $totalEarned = $myPassed->sum(function ($regist) {
                                return $regist->subject->subject_credit;
                            });
                            $isComplete = $totalEarned >= $item->credit_needed;
                        @endphp

                        {{-- แถวประเภทวิชาย่อย (เช่น กลุ่มวิชาแกน) --}}
                        <tr class="bg-light">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="ps-3 fw-semibold text-primary">
                                {{ $item->type_name }}
                            </td>
                            <td class="text-center">
                                @if($isComplete)
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> ครบแล้ว</span>
                                @else
                                    <span class="badge bg-warning text-dark">ยังไม่ครบ</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->credit_needed }}</td>
                            <td class="text-center fw-bold {{ $isComplete ? 'text-success' : 'text-danger' }}">
                                {{ $totalEarned }}
                            </td>
                        </tr>

                        {{-- แสดงรายวิชาที่ลงทะเบียนแล้วในประเภทนี้ --}}
                        @if($myPassed->count() > 0)
                            @foreach($myPassed as $regist)
                            <tr class="border-start border-4 border-info">
                                <td></td>
                                <td class="ps-5">
                                    <small class="text-muted d-block">{{ $regist->subject->subject_code }}</small>
                                    <span>{{ $regist->subject->subject_name_th }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge outline-primary border border-primary text-primary px-3">
                                        {{ $regist->grade }}
                                    </span>
                                </td>
                                <td class="text-center text-muted small italic">เกรดผ่าน</td>
                                <td class="text-center text-muted">{{ $regist->subject->subject_credit }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td colspan="4" class="text-center text-muted small py-1">
                                    -- ยังไม่มีประวัติการลงทะเบียนในกลุ่มนี้ --
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-end">
        <p class="text-muted small">* หมายเหตุ: หน่วยกิตจะนับเฉพาะวิชาที่ได้เกรดผ่านตามเกณฑ์ของมหาวิทยาลัยเท่านั้น</p>
    </div>
</div>
@endsection