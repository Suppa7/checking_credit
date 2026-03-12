@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลกลุ่มวิชา (Subject Category)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subject_categories.update', $subject_category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="category_name" class="form-label fw-bold">ชื่อกลุ่มวิชา</label>
                            <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name', $subject_category->category_name) }}" required>
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="credit_needed" class="form-label fw-bold">หน่วยกิตที่ต้องการ</label>
                            <input type="number" min="0" class="form-control @error('credit_needed') is-invalid @enderror" id="credit_needed" name="credit_needed" value="{{ old('credit_needed', $subject_category->credit_needed) }}" required>
                            @error('credit_needed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subject_categories.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
