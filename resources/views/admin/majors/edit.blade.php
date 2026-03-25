@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.majors.index') }}">จัดการหลักสูตร (Major)</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลหลักสูตร (Major)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลหลักสูตร (Major)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.majors.update', $major) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="major_id" class="form-label fw-bold">รหัสหลักสูตร</label>
                            <input type="text" class="form-control @error('major_id') is-invalid @enderror" id="major_id" name="major_id" value="{{ old('major_id', $major->major_id) }}" required>
                            @error('major_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="major_name_thai" class="form-label fw-bold">ชื่อหลักสูตร (ภาษาไทย)</label>
                            <input type="text" class="form-control @error('major_name_thai') is-invalid @enderror" id="major_name_thai" name="major_name_thai" value="{{ old('major_name_thai', $major->major_name_thai) }}" required>
                            @error('major_name_thai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.majors.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
