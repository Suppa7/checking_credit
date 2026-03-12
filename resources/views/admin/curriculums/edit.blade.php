@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลเล่มหลักสูตร (Curriculum)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curriculums.update', $curriculum) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="program_name" class="form-label fw-bold">ชื่อแผนการศึกษา (Program Name)</label>
                            <input type="text" class="form-control @error('program_name') is-invalid @enderror" id="program_name" name="program_name" value="{{ old('program_name', $curriculum->program_name) }}" required>
                            @error('program_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="curriculum_name" class="form-label fw-bold">ชื่อหลักสูตร (Curriculum Name)</label>
                            <input type="text" class="form-control @error('curriculum_name') is-invalid @enderror" id="curriculum_name" name="curriculum_name" value="{{ old('curriculum_name', $curriculum->curriculum_name) }}" required>
                            @error('curriculum_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="curriculum_year" class="form-label fw-bold">ปีที่ปรับปรุงหลักสูตร (Year)</label>
                            <input type="text" class="form-control @error('curriculum_year') is-invalid @enderror" id="curriculum_year" name="curriculum_year" value="{{ old('curriculum_year', $curriculum->curriculum_year) }}" required maxlength="4">
                            @error('curriculum_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.curriculums.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
