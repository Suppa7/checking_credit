@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <table class="table table-responsive"> 
            <thead class="text-center table-dark">
                <th>ลำดับ</th>
                <th>หมวดหมู่วิชา</th>
                <th>สถานะ</th>
                <th>หน่วยกิตตามกำหนด</th>
                <th>หน่วยกิตของนักศึกษา</th>
            </thead>
            <tbody>
                @foreach(Auth::user()->student->curriculum->curriculum_subject as $items)
                    <tr>
                        <td colspan="2" class="fw-bold">{{ $items->subject_category->category_name }}</td>
                        <td></td>
                        <td class="fw-bold">{{ $items->subject_category->credit_needed }}</td>
                        <td></td>
                    </tr>
                    @foreach($items->subject_category->subject_type as $item)
                    @php
                        // 1. ดึงรายการที่สอบผ่านของ Type นี้จากตัวแปรที่เรา Group ไว้
                        // ถ้าไม่มีข้อมูล ให้ return เป็น Collection ว่างๆ เพื่อกัน Error
                        $myPassed = $groupedPassedSubjects->get($item->id, collect());
                        // 2. คำนวณผลรวมหน่วยกิต (Sum) จาก Relation subject -> credit
                        $totalEarned = $myPassed->sum(function ($regist) {
                            return $regist->subject->subject_credit;
                        });

                        // 3. เช็คเงื่อนไขว่าครบหรือยัง
                        $isComplete = $totalEarned >= $item->credit_needed;
                    @endphp
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->type_name }}</td>
                            <td class="text-center">
                                @if($isComplete)
                                    <span class="badge bg-success">ครบแล้ว</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->credit_needed}}</td>
                            {{-- ช่องหน่วยกิตที่ได้ (ด้านหลัง Credit) --}}
                            <td class="fw-bold {{ $isComplete ? 'text-success' : 'text-danger' }}">
                                {{ $totalEarned }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection