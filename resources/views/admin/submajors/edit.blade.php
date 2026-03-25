@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.submajors.index') }}">จัดการวิชาเอก (Submajor)</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลวิชาเอก (Submajor)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลวิชาเอก (Submajor)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.submajors.update', $submajor) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="submajor_id" class="form-label fw-bold">รหัสวิชาเอก</label>
                            <input type="text" class="form-control @error('submajor_id') is-invalid @enderror" id="submajor_id" name="submajor_id" value="{{ old('submajor_id', $submajor->submajor_id) }}" required>
                            @error('submajor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="submajor_name_thai" class="form-label fw-bold">ชื่อวิชาเอก (ภาษาไทย)</label>
                            <input type="text" class="form-control @error('submajor_name_thai') is-invalid @enderror" id="submajor_name_thai" name="submajor_name_thai" value="{{ old('submajor_name_thai', $submajor->submajor_name_thai) }}" required>
                            @error('submajor_name_thai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="major_id" class="form-label fw-bold">หลักสูตร (Major) สังกัด</label>
                            <select class="form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" required>
                                <option value="" disabled>-- เลือกหลักสูตร --</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}" {{ old('major_id', $submajor->major_id) == $major->id ? 'selected' : '' }}>
                                        {{ $major->major_id }} - {{ $major->major_name_thai }}
                                    </option>
                                @endforeach
                            </select>
                            @error('major_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.submajors.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
