@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculums.index') }}">เล่มหลักสูตร</a></li>
    <li class="breadcrumb-item active" aria-current="page">รายวิชาในเล่ม</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">รายละเอียดรายวิชาในเล่มหลักสูตร</h4>
        <a href="{{ route('admin.curriculums.index') }}" class="btn btn-light rounded-pill px-4 shadow-sm">
            <i class="bi bi-arrow-left me-1"></i>ย้อนกลับ
        </a>
    </div>


    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
        <div class="card-body p-4 bg-primary text-white">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 class="fw-bold mb-1">{{ $curriculum->major->major_name_thai }}</h3>
                    <p class="mb-0 opacity-75 fs-5">ปีที่ปรับปรุง: {{ $curriculum->curriculum_year }}</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 shadow-sm">
                        {{ $curriculum->curriculum_type->count() }} รูปแบบหลักสูตร
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-light border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0 text-primary-emphasis">
                        <i class="bi bi-journal-check me-2"></i>รายวิชาทั้งหมดในเล่มหลักสูตร
                    </h5>
                    <span class="badge bg-primary rounded-pill px-3 fs-6">
                        รวมทั้งหมด: {{ $curriculum->subject_curriculum->count() }} วิชา
                    </span>
                </div>
                <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light text-muted small text-uppercase sticky-top">
                            <tr>
                                <th class="px-4 py-3" width="150">รหัสวิชา</th>
                                <th class="px-4 py-3">ชื่อรายวิชา</th>
                                <th class="px-4 py-3">หมวด/ประเภทวิชา</th>
                                <th class="px-4 py-3 text-center" width="100">หน่วยกิต</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($curriculum->subject_curriculum as $sc)
                                @php $subject = $sc->subject; @endphp
                                <tr>
                                    <td class="px-4 py-3">
                                        <span class="font-monospace fw-bold text-dark">{{ $subject->subject_code }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-dark">{{ $subject->subject_name }}</td>
                                    <td class="px-4 py-3">
                                        <div class="small">
                                            <span class="text-primary fw-bold">{{ $subject->subject_type->subject_category->category_name ?? '-' }}</span>
                                            <i class="bi bi-chevron-right mx-1 small text-muted"></i>
                                            <span class="text-muted">{{ $subject->subject_type->type_name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="badge bg-info bg-opacity-10 text-info fw-bold rounded-pill px-3">
                                            {{ $subject->subject_credit }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted fst-italic">
                                        ยังไม่มีข้อมูลรายวิชาที่ผูกกับหลักสูตรนี้
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .rounded-custom {
        border-radius: 1rem;
    }
    .text-primary-emphasis {
        color: #052c65 !important;
    }
    .table > :not(caption) > * > * {
        border-bottom-width: 1px;
        border-bottom-color: rgba(0,0,0,0.05);
    }
    .table > tbody > tr:last-child > td {
        border-bottom-width: 0;
    }
    .fw-mono {
        font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
    }
</style>
@endsection
