@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.subjects.index') }}">จัดการรายวิชา (Subject)</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มข้อมูลรายวิชา (Subject)</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h3 class="mb-0">เพิ่มข้อมูลรายวิชา (Subject)</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.subjects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="subject_code" class="form-label fw-bold">รหัสวิชา</label>
                            <input type="text" class="form-control @error('subject_code') is-invalid @enderror" id="subject_code" name="subject_code" value="{{ old('subject_code') }}" required>
                            @error('subject_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_name" class="form-label fw-bold">ชื่อวิชา</label>
                            <input type="text" class="form-control @error('subject_name') is-invalid @enderror" id="subject_name" name="subject_name" value="{{ old('subject_name') }}" required>
                            @error('subject_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_credit" class="form-label fw-bold">หน่วยกิต <small class="text-muted">(เช่น 3(2-2-5))</small></label>
                            <input type="text" class="form-control @error('subject_credit') is-invalid @enderror" id="subject_credit" name="subject_credit" value="{{ old('subject_credit') }}" required>
                            @error('subject_credit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="subject_type_id" class="form-label fw-bold">หมวดวิชา</label>
                            <select class="form-select @error('subject_type_id') is-invalid @enderror" id="subject_type_id" name="subject_type_id" required>
                                <option value="" disabled selected>-- เลือกหมวดวิชา --</option>
                                @foreach($subject_types as $type)
                                    <option value="{{ $type->id }}" {{ old('subject_type_id') == $type->id ? 'selected' : '' }}>
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
                                    <option value="{{ $own->id }}" {{ old('subject_own_id') == $own->id ? 'selected' : '' }}>
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
                        <div class="mb-4">
                            <label for="curriculum_ids" class="form-label fw-bold">หลักสูตรที่เปิดสอน</label>
                            <select name="curriculum_ids[]" id="curriculum_ids" multiple class="form-select select2-curriculum">
                                @foreach($curriculums as $curriculum)
                                    <option value="{{ $curriculum->id }}" {{ in_array($curriculum->id, old('curriculum_ids', [])) ? 'selected' : '' }}>
                                        {{ $curriculum->major->major_name_thai }} (ปี {{ $curriculum->curriculum_year }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text text-muted">พิมพ์เพื่อค้นหา หรือคลิกเพื่อเลือกหลักสูตร (เลือกได้หลายรายการ)</div>
                            @error('curriculum_ids')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <!-- Select2 Bootstrap 5 Theme -->
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <style>
        /* Modern Premium Select2 Styling */
        .select2-container--bootstrap-5 .select2-selection {
            border-radius: 0.75rem !important;
            border: 1px solid #e2e8f0 !important;
            min-height: 48px !important;
            padding: 0.5rem 0.75rem !important;
            background-color: #ffffff !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            border-color: #4f46e5 !important;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 0.5rem !important;
            padding: 4px 12px !important;
            font-weight: 500 !important;
            margin-top: 5px !important;
            font-size: 0.875rem !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            color: #64748b !important;
            margin-right: 8px !important;
            border: none !important;
            background: transparent !important;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #ef4444 !important;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted[aria-selected] {
            background-color: #4f46e5 !important;
            color: #ffffff !important;
        }

        .select2-container--bootstrap-5 .select2-dropdown {
            border-radius: 0.75rem !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            overflow: hidden !important;
        }
    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        // Apply Select2 to all relevant dropdowns
        $('#subject_type_id, #subject_own_id, .select2-curriculum').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: function() {
                return $(this).attr('placeholder') || $(this).attr('title') || '-- เลือก --';
            },
            allowClear: true
        });

        // Specific multi-select config for curriculum
        $('.select2-curriculum').select2({
            theme: 'bootstrap-5',
            placeholder: '-- ค้นหาและเลือกหลักสูตร --',
            allowClear: true,
            closeOnSelect: false,
            width: '100%'
        });
    });
</script>
@endpush
