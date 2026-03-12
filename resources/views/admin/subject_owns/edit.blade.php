@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลเจ้าของวิชา (Subject Own)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subject_owns.update', $subject_own) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="major_id" class="form-label fw-bold">หลักสูตร (Major)</label>
                            <select class="form-select @error('major_id') is-invalid @enderror" id="major_id" name="major_id" required>
                                <option value="" disabled>-- เลือกหลักสูตร --</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->id }}" {{ old('major_id', $subject_own->major_id) == $major->id ? 'selected' : '' }}>
                                        {{ $major->major_name_thai }}
                                    </option>
                                @endforeach
                            </select>
                            @error('major_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="submajor_id" class="form-label fw-bold">วิชาเอก (Submajor) (เลือกได้ถ้ามี)</label>
                            <select class="form-select @error('submajor_id') is-invalid @enderror" id="submajor_id" name="submajor_id">
                                <option value="">-- ไม่มีวิชาเอก --</option>
                                @foreach($submajors as $submajor)
                                    <option value="{{ $submajor->id }}" {{ old('submajor_id', $subject_own->submajor_id) == $submajor->id ? 'selected' : '' }}>
                                        {{ $submajor->submajor_name_thai }} ({{ $submajor->major->major_name_thai ?? '' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('submajor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subject_owns.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
