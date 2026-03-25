@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการหลักสูตร (Major)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการหลักสูตร (Major)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.majors.create') }}" class="btn btn-primary">เพิ่มหลักสูตร</a>
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
                            <th class="px-4 py-3">รหัสหลักสูตร</th>
                            <th class="px-4 py-3">ชื่อหลักสูตร (ภาษาไทย)</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($majors as $major)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $major->major_id }}</td>
                            <td class="px-4 py-3 align-middle">{{ $major->major_name_thai }}</td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.majors.edit', $major) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('admin.majors.destroy', $major) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
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
