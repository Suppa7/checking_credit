@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการกลุ่มวิชา (Subject Category)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการกลุ่มวิชา (Subject Category)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.subject_categories.create') }}" class="btn btn-primary">เพิ่มกลุ่มวิชา</a>
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
                            <th class="px-4 py-3">ชื่อกลุ่มวิชา</th>
                            <th class="px-4 py-3">กลุ่มย่อย (Subject Type)</th>
                            <th class="px-4 py-3 text-center">หน่วยกิตที่ต้องการ (รวม)</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subject_categories as $category)
                        <tr>
                            <td class="px-4 py-3 align-middle fw-bold text-primary">{{ $category->category_name }}</td>
                            <td class="px-4 py-3 align-middle">
                                @if($category->subject_type->isNotEmpty())
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($category->subject_type as $type)
                                            <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                                <i class="bi bi-tag-fill text-primary me-1"></i>
                                                {{ $type->type_name }} 
                                                <span class="text-muted ms-1">({{ $type->credit_needed }} หน่วยกิต)</span>
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-muted small italic text-secondary">-- ไม่มีกลุ่มย่อย --</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center align-middle">
                                <span class="badge bg-primary rounded-pill px-3 fs-6">
                                    {{ $category->credit_needed }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.subject_categories.edit', $category) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">แก้ไข</a>
                                <form action="{{ route('admin.subject_categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center px-4 py-4 text-muted">ไม่พบข้อมูล</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
