@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculums.index') }}">จัดการเล่มหลักสูตร (Curriculum)</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลเล่มหลักสูตร (Curriculum)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">เพิ่มข้อมูลเล่มหลักสูตร (Curriculum)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curriculums.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="major_id" class="form-label fw-bold">สาขาวิชา (Major)</label>
                            <select class="form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" required>
                                <option value="">-- เลือกสาขาวิชา --</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                        {{ $major->major_name_thai }}
                                    </option>
                                @endforeach
                            </select>
                            @error('major_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="curriculum_year" class="form-label fw-bold">ปีที่ปรับปรุงหลักสูตร (Year)</label>
                            <input type="text" class="form-control @error('curriculum_year') is-invalid @enderror" id="curriculum_year" name="curriculum_year" value="{{ old('curriculum_year') }}" required maxlength="4">
                            @error('curriculum_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.curriculums.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
