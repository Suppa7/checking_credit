@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการวิชาในหลักสูตร (Curriculum Subjects)</li>
@endsection

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>จัดการวิชาในหลักสูตร (Curriculum Subjects)</h2>
            <div>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
                <a href="{{ route('admin.curriculum_subjects.create') }}" class="btn btn-primary">เพิ่มวิชาในหลักสูตร</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">เล่มหลักสูตร (Curriculum)</th>
                                <th class="px-4 py-3">กลุ่มวิชา (Category)</th>
                                <th class="px-4 py-3 text-end">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($curriculum_subjects as $type_id => $group)
                                @php $first = $group->first(); @endphp
                                <tr class="hover-bg-light">
                                    <td class="px-4 py-3 align-middle">
                                        <div class="fw-bold text-primary fs-6">
                                            {{ $first->curriculum_type->type_name ?? '-' }}
                                            @if($first->curriculum_type->submajor)
                                                <span class="text-secondary small">({{ $first->curriculum_type->submajor->submajor_name_thai }})</span>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            {{ $first->curriculum_type->curriculum->major->major_name_thai ?? '-' }} 
                                            ({{ $first->curriculum_type->curriculum->curriculum_year ?? '' }})
                                        </small>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($group as $item)
                                                <span class="badge bg-info text-dark shadow-sm border">
                                                    <i class="bi bi-tag-fill me-1"></i>
                                                    {{ $item->subject_category->category_name ?? '-' }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-end align-middle">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.curriculum_subjects.edit', $first) }}"
                                                class="btn btn-sm btn-outline-warning rounded-pill px-3 shadow-sm hover-lift"
                                                title="แก้ไขทั้งหมดในกลุ่มนี้">
                                                <i class="bi bi-pencil-square me-1"></i> แก้ไข
                                            </a>
                                            <form action="{{ route('admin.curriculum_subjects.destroy', $first) }}"
                                                method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบรายการนี้? (การลบจะลบเฉพาะรายการที่เลือก หากต้องการลบข้อมูลทั้งหมดในกลุ่ม แนะนำให้ลบทีละรายการหรือใช้ฟังก์ชันแก้ไข)');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 shadow-sm hover-lift">
                                                    <i class="bi bi-trash-fill me-1"></i> ลบ
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center px-4 py-5 text-muted">
                                        <span class="fs-2 mb-3 d-block">📂</span>
                                        ไม่พบข้อมูลวิชาในหลักสูตร
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