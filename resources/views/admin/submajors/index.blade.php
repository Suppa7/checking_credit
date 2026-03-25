@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการวิชาเอก (Submajor)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการวิชาเอก (Submajor)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.submajors.create') }}" class="btn btn-primary">เพิ่มวิชาเอก</a>
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
                            <th class="px-4 py-3">รหัสวิชาเอก</th>
                            <th class="px-4 py-3">ชื่อวิชาเอก (ภาษาไทย)</th>
                            <th class="px-4 py-3">หลักสูตร (Major)</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submajors as $submajor)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $submajor->submajor_id }}</td>
                            <td class="px-4 py-3 align-middle">{{ $submajor->submajor_name_thai }}</td>
                            <td class="px-4 py-3 align-middle">{{ $submajor->major->major_name_thai ?? '-' }}</td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.submajors.edit', $submajor) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('admin.submajors.destroy', $submajor) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
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
