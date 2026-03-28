@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculum_types.index') }}">จัดการรูปแบบหลักสูตร</a></li>
    <li class="breadcrumb-item active" aria-current="page">แก้ไขรูปแบบหลักสูตร</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">แก้ไขรูปแบบหลักสูตร</h5>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.curriculum_types.update', $curriculumType) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="curriculum_id" class="form-label">เล่มหลักสูตร (Curriculum)</label>
                            <select name="curriculum_id" id="curriculum_id" class="form-select @error('curriculum_id') is-invalid @enderror" required>
                                    <option value="{{ $curriculumType->curriculum_id }}" data-major-id="{{ $curriculumType->curriculum->major_id }}" >
                                        {{ $curriculumType->curriculum->major->major_name_thai }} (ปี {{ $curriculumType->curriculum->curriculum_year }})
                                    </option>
                            </select>
                            @error('curriculum_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="submajor_container" class="mb-3">
                            <label for="submajor_id" class="form-label">วิชาเอก (Submajor)</label>
                            <select name="submajor_id" id="submajor_id" class="form-select @error('submajor_id') is-invalid @enderror">
                                @foreach($majors as $major)
                                        @foreach($major->submajors as $submajor)
                                            <option value="{{ $submajor->id }}" {{ old('submajor_id', $curriculumType->submajor_id) == $submajor->id ? 'selected' : '' }}>
                                                {{ $submajor->submajor_name_thai }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            @error('submajor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_name" class="form-label">ชื่อรูปแบบ (Type Name)</label>
                            <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror" value="{{ old('type_name', $curriculumType->type_name) }}" required>
                            @error('type_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.curriculum_types.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">อัปเดตข้อมูล</button>
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
        function toggleSubmajor() {
            const selectedOption = $('#curriculum_id option:selected');
            const majorId = selectedOption.data('major-id');
            const submajorContainer = $('#submajor_container');
            const submajorSelect = $('#submajor_id');

            if (majorId == 1) {
                submajorContainer.show();
                submajorSelect.attr('required', 'required');
            } else {
                submajorContainer.hide();
                submajorSelect.removeAttr('required');
                submajorSelect.val('');
            }
        }

        $('#curriculum_id').on('change', toggleSubmajor);
        toggleSubmajor(); // Initial call
    });
</script>
@endpush
@endsection
