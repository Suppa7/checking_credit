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
                    <h3 class="fw-bold mb-1">{{ $curriculum->program_name }}</h3>
                    <p class="mb-0 opacity-75 fs-5">{{ $curriculum->curriculum_name }} (ปีที่ปรับปรุง: {{ $curriculum->curriculum_year }})</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 shadow-sm">
                        {{ $curriculum->curriculum_type->count() }} รูปแบบหลักสูตร
                    </span>
                </div>
            </div>
        </div>
    </div>

    @forelse($curriculum->curriculum_type as $type)
        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-journal-text text-white"></i>
                </div>
                <h4 class="fw-bold mb-0 text-dark">{{ $type->type_name }}</h4>
            </div>

            <div class="row">
                @forelse($type->curriculum_subject as $curriculumSubject)
                    @if($curriculumSubject->subject_category)
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm rounded-custom overflow-hidden">
                                <div class="card-header bg-light border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bold mb-0 text-primary-emphasis">
                                        <i class="bi bi-layers me-2"></i>{{ $curriculumSubject->subject_category->category_name }}
                                    </h5>
                                    <span class="badge bg-primary rounded-pill px-3">
                                        หน่วยกิตที่ต้องการ: {{ $curriculumSubject->subject_category->credit_needed }}
                                    </span>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 align-middle">
                                            <thead class="table-light text-muted small text-uppercase">
                                                <tr>
                                                    <th class="px-4 py-3" width="150">รหัสวิชา</th>
                                                    <th class="px-4 py-3">ชื่อรายวิชา</th>
                                                    <th class="px-4 py-3 text-center" width="100">หน่วยกิต</th>
                                                    <th class="px-4 py-3">กลุ่มวิชา</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $hasSubjects = false; @endphp
                                                @foreach($curriculumSubject->subject_category->subject_type as $subjectType)
                                                    @foreach($subjectType->subjects as $subject)
                                                        @php $hasSubjects = true; @endphp
                                                        <tr>
                                                            <td class="px-4 py-3">
                                                                <span class="font-monospace fw-bold text-dark">{{ $subject->subject_code }}</span>
                                                            </td>
                                                            <td class="px-4 py-3 text-dark">{{ $subject->subject_name }}</td>
                                                            <td class="px-4 py-3 text-center">
                                                                <span class="badge bg-info bg-opacity-10 text-info fw-bold rounded-pill px-3">
                                                                    {{ $subject->subject_credit }}
                                                                </span>
                                                            </td>
                                                            <td class="px-4 py-3">
                                                                <small class="text-muted">{{ $subjectType->type_name }}</small>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach

                                                @if(!$hasSubjects)
                                                    <tr>
                                                        <td colspan="4" class="text-center py-4 text-muted fst-italic">
                                                            ไม่มีข้อมูลรายวิชาในหมวดนี้
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-12 text-center py-4 text-muted">
                        ไม่พบข้อมูลหมวดวิชา
                    </div>
                @endforelse
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-inbox fs-1 text-muted opacity-50"></i>
            </div>
            <h5 class="text-muted">ยังไม่มีการกำหนดรูปแบบหลักสูตรสำหรับเล่มนี้</h5>
            <a href="{{ route('admin.curriculum_types.create') }}" class="btn btn-primary mt-3 rounded-pill px-4">
                เพิ่มรูปแบบหลักสูตร
            </a>
        </div>
    @endforelse
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
