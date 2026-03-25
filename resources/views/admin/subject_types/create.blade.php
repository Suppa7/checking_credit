@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subject_types.index') }}">จัดการหมวดวิชา (Subject Type)</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลหมวดวิชา (Subject Type)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">เพิ่มข้อมูลหมวดวิชา (Subject Type)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subject_types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="subject_category_id" class="form-label fw-bold">สังกัดกลุ่มวิชา (Category)</label>
                            <select class="form-select @error('subject_category_id') is-invalid @enderror" id="subject_category_id" name="subject_category_id" required>
                                <option value="" disabled selected>-- เลือกกลุ่มวิชา --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('subject_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type_name" class="form-label fw-bold">ชื่อหมวดวิชา</label>
                            <input type="text" class="form-control @error('type_name') is-invalid @enderror" id="type_name" name="type_name" value="{{ old('type_name') }}" required>
                            @error('type_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="credit_needed" class="form-label fw-bold">หน่วยกิตที่ต้องการ</label>
                            <input type="number" min="0" class="form-control @error('credit_needed') is-invalid @enderror" id="credit_needed" name="credit_needed" value="{{ old('credit_needed') }}" required>
                            @error('credit_needed')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subject_types.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
