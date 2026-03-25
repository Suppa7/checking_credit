@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">จัดการรายวิชา (Subject)</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลรายวิชา (Subject)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลรายวิชา (Subject)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subjects.update', $subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="subject_code" class="form-label fw-bold">รหัสวิชา</label>
                            <input type="text" class="form-control @error('subject_code') is-invalid @enderror" id="subject_code" name="subject_code" value="{{ old('subject_code', $subject->subject_code) }}" required>
                            @error('subject_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_name" class="form-label fw-bold">ชื่อวิชา</label>
                            <input type="text" class="form-control @error('subject_name') is-invalid @enderror" id="subject_name" name="subject_name" value="{{ old('subject_name', $subject->subject_name) }}" required>
                            @error('subject_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_credit" class="form-label fw-bold">หน่วยกิต <small class="text-muted">(เช่น 3(2-2-5))</small></label>
                            <input type="text" class="form-control @error('subject_credit') is-invalid @enderror" id="subject_credit" name="subject_credit" value="{{ old('subject_credit', $subject->subject_credit) }}" required>
                            @error('subject_credit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_type_id" class="form-label fw-bold">หมวดวิชา</label>
                            <select class="form-select @error('subject_type_id') is-invalid @enderror" id="subject_type_id" name="subject_type_id" required>
                                <option value="" disabled>-- เลือกหมวดวิชา --</option>
                                @foreach($subject_types as $type)
                                    <option value="{{ $type->id }}" {{ old('subject_type_id', $subject->subject_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->type_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subject_own_id" class="form-label fw-bold">เจ้าของวิชา (เลือกได้ถ้ามี)</label>
                            <select class="form-select @error('subject_own_id') is-invalid @enderror" id="subject_own_id" name="subject_own_id">
                                <option value="">-- ส่วนกลาง / ไม่มีเจ้าของพิเศษ --</option>
                                @foreach($subject_owns as $own)
                                    <option value="{{ $own->id }}" {{ old('subject_own_id', $subject->subject_own_id) == $own->id ? 'selected' : '' }}>
                                        {{ $own->major->major_name_thai ?? '' }} 
                                        @if($own->submajor)
                                            - {{ $own->submajor->submajor_name_thai }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_own_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
