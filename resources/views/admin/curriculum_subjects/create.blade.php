@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculum_subjects.index') }}">จัดการวิชาในหลักสูตร (Curriculum Subjects)</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลวิชาในหลักสูตร (Curriculum Subjects)</li>    
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">เพิ่มข้อมูลวิชาในหลักสูตร</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curriculum_subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="curriculum_id" class="form-label fw-bold">เล่มหลักสูตร (Curriculum)</label>
                            <select class="form-select @error('curriculum_id') is-invalid @enderror" id="curriculum_id" name="curriculum_id" required>
                                <option value="" disabled selected>-- เลือกเล่มหลักสูตร --</option>
                                @foreach($curriculums as $curriculum)
                                    <option value="{{ $curriculum->id }}" {{ old('curriculum_id') == $curriculum->id ? 'selected' : '' }}>
                                        {{ $curriculum->curriculum_name }} ({{ $curriculum->curriculum_year }})
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subject_category_id" class="form-label fw-bold">กลุ่มวิชา (Subject Category)</label>
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
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.curriculum_subjects.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
