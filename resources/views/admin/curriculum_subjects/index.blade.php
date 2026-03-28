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
                            @forelse($curriculum_subjects as $curriculum_subject)
                                <tr>
                                    <td class="px-4 py-3 align-middle">
                                        {{ $curriculum_subject->curriculum_type->curriculum->major->major_name_thai ?? '-' }}
                                        <br><small class="text-muted">ปี
                                            {{ $curriculum_subject->curriculum_type->curriculum->curriculum_year ?? '' }}</small>
                                    </td>
                                    <td class="px-4 py-3 align-middle">
                                        {{ $curriculum_subject->subject_category->category_name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-end align-middle">
                                        <a href="{{ route('admin.curriculum_subjects.edit', $curriculum_subject) }}"
                                            class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                        <form action="{{ route('admin.curriculum_subjects.destroy', $curriculum_subject) }}"
                                            method="POST" class="d-inline" onsubmit="return confirm('ยืนยันการลบข้อมูล?');">
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