@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculum_subjects.index') }}">จัดการวิชาในหลักสูตร (Curriculum Subjects)</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลวิชาในหลักสูตร (Curriculum Subjects)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">แก้ไขข้อมูลวิชาในหลักสูตร</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curriculum_subjects.update', $curriculum_subject) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="curriculum_type_id" class="form-label fw-bold">ประเภทหลักสูตร (Curriculum Type)</label>
                            <select class="form-select @error('curriculum_type_id') is-invalid @enderror" id="curriculum_type_id" name="curriculum_type_id" required>
                                <option value="" disabled>-- เลือกประเภทหลักสูตร --</option>
                                @foreach($curriculum_types as $type)
                                    <option value="{{ $type->id }}" {{ old('curriculum_type_id', $curriculum_subject->curriculum_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->curriculum->major->major_name_thai ?? '-' }} 
                                        ({{ $type->curriculum->curriculum_year }}) - 
                                        {{ $type->type_name }}
                                        @if($type->submajor)
                                            ({{ $type->submajor->submajor_name_thai }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subject_category_ids" class="form-label fw-bold">กลุ่มวิชา (Subject Categories)</label>
                            <select class="form-select select2 @error('subject_category_ids') is-invalid @enderror" id="subject_category_ids" name="subject_category_ids[]" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (is_array(old('subject_category_ids', $selected_categories)) && in_array($category->id, old('subject_category_ids', $selected_categories))) ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted small">สามารถเลือกได้มากกว่า 1 กลุ่มวิชา</div>
                            @error('subject_category_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.curriculum_subjects.index') }}" class="btn btn-secondary rounded-pill px-4">ยกเลิก</a>
                            <button type="submit" class="btn btn-warning rounded-pill px-4 shadow-sm text-dark">อัปเดตข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            placeholder: "-- เลือกกลุ่มวิชา --",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
@endsection
