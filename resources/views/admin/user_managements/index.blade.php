@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">เมนูจัดการข้อมูล</a></li>
    <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งาน (Users)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>จัดการผู้ใช้งาน (Users)</h2>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">กลับหน้าหลัก</a>
            <a href="{{ route('admin.user_managements.create') }}" class="btn btn-primary">เพิ่มผู้ใช้งาน</a>
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
                            <th class="px-4 py-3">Student ID</th>
                            <th class="px-4 py-3">ชื่อ-นามสกุล</th>
                            <th class="px-4 py-3 text-center">หลักสูตร / วิชาเอก</th>
                            <th class="px-4 py-3 text-center">เล่มหลักสูตร</th>
                            <th class="px-4 py-3 text-center">สร้างเมื่อ</th>
                            <th class="px-4 py-3 text-end">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-3 align-middle">{{ $user->student_id }}</td>
                            <td class="px-4 py-3 align-middle">
                                @if($user->student)
                                    {{ $user->student->student_name }}
                                @else
                                    <span class="text-muted small">ไม่มีข้อมูลนักศึกษา</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 align-middle text-center">
                                @if($user->student && $user->student->curriculum)
                                    <div class="text-muted" style="font-size: 0.75rem;">
                                        {{ $user->student->major ? $user->student->major->major_name_thai : '-' }} / 
                                        {{ $user->student->submajor ? $user->student->submajor->submajor_name_thai : '-' }}
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-3 align-middle text-center">
                                <div class="fw-bold small">{{ $user->student->curriculum->program_name }} {{ $user->student->curriculum->curriculum_year }}</div>
                            </td>
                            <td class="px-4 py-3 align-middle text-center small text-muted">{{ $user->created_at->format('d/m/Y H:i') }}</td>

                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.user_managements.edit', $user) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('admin.user_managements.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบผู้ใช้?');">
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
