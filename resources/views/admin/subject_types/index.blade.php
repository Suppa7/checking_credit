@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการหมวดวิชา (Subject Type)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.subject_types.create') }}" class="btn btn-primary">เพิ่มหมวดวิชา</a>
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
                            <th class="px-4 py-3">กลุ่มวิชา (Category)</th>
                            <th class="px-4 py-3">ชื่อหมวดวิชา</th>
                            <th class="px-4 py-3 text-center">หน่วยกิตที่ต้องการ</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subject_types as $type)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $type->subject_category->category_name ?? '-' }}</td>
                            <td class="px-4 py-3 align-middle">{{ $type->type_name }}</td>
                            <td class="px-4 py-3 text-center align-middle">{{ $type->credit_needed }}</td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.subject_types.edit', $type) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('admin.subject_types.destroy', $type) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center px-4 py-4 text-muted">ไม่พบข้อมูล</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
