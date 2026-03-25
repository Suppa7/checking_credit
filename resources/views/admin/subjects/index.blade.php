@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการรายวิชา (Subject)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการรายวิชา (Subject)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">เพิ่มรายวิชา</a>
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
                            <th class="px-4 py-3">รหัสวิชา</th>
                            <th class="px-4 py-3">ชื่อวิชา</th>
                            <th class="px-4 py-3">หน่วยกิต</th>
                            <th class="px-4 py-3">หมวดวิชา</th>
                            <th class="px-4 py-3">เจ้าของวิชา</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subjects as $subject)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $subject->subject_code }}</td>
                            <td class="px-4 py-3 align-middle">{{ $subject->subject_name }}</td>
                            <td class="px-4 py-3 align-middle">{{ $subject->subject_credit }}</td>
                            <td class="px-4 py-3 align-middle">{{ $subject->subject_type->type_name ?? '-' }}</td>
                            <td class="px-4 py-3 align-middle">
                                @if($subject->subject_own)
                                    {{ $subject->subject_own->major->major_name_thai ?? '' }}
                                    @if($subject->subject_own->submajor)
                                        <br><small class="text-muted">({{ $subject->subject_own->submajor->submajor_name_thai }})</small>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.subjects.edit', $subject) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center px-4 py-4 text-muted">ไม่พบข้อมูล</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
