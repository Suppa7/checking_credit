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
                    <form action="{{ route('admin.curriculum_types.update', $curriculumType) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="curriculum_id" class="form-label">เล่มหลักสูตร (Curriculum)</label>
                            <select name="curriculum_id" id="curriculum_id" class="form-select @error('curriculum_id') is-invalid @enderror" required>
                                <option value="">-- เลือกเล่มหลักสูตร --</option>
                                @foreach($curriculums as $curriculum)
                                    <option value="{{ $curriculum->id }}" {{ old('curriculum_id', $curriculumType->curriculum_id) == $curriculum->id ? 'selected' : '' }}>
                                        {{ $curriculum->major->major_name_thai }} (ปี {{ $curriculum->curriculum_year }})
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="submajor_id" class="form-label">แขนงวิชา (Submajor)</label>
                            <select name="submajor_id" id="submajor_id" class="form-select @error('submajor_id') is-invalid @enderror" required>
                                <option value="">-- เลือกแขนงวิชา --</option>
                                @foreach($majors as $major)
                                    <optgroup label="{{ $major->major_name_thai }}">
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
                        <div class="mb-4">
                            <label class="form-label fw-bold">การกำหนดสิทธิ์การเรียนข้ามแขนง (Submajor Measure)</label>
                            <div class="table-responsive border rounded-3">
                                <table class="table table-sm table-hover mb-0">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th class="text-start ps-3">Major / Submajor</th>
                                            <th width="120">Allowed</th>
                                            <th width="120">Not Allowed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($majors as $major)
                                            <tr class="table-secondary bg-opacity-10">
                                                <td colspan="3" class="ps-3 fw-bold small text-uppercase text-muted">{{ $major->major_name_thai }}</td>
                                            </tr>
                                            @foreach($major->submajors as $submajor)
                                                @php
                                                    $currentValue = $measures[$submajor->id] ?? 'not allowed';
                                                @endphp
                                                <tr>
                                                    <td class="ps-4 align-middle">{{ $submajor->submajor_name_thai }}</td>
                                                    <td class="text-center align-middle">
                                                        <input class="form-check-input" type="radio" name="submajor_measures[{{ $submajor->id }}]" value="allowed" {{ $currentValue == 'allowed' ? 'checked' : '' }}>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <input class="form-check-input" type="radio" name="submajor_measures[{{ $submajor->id }}]" value="not allowed" {{ $currentValue == 'not allowed' ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <small class="text-muted mt-2 d-block">* 'Allowed' หมายถึงนักศึกษาสามารถเลือกเรียนวิชาโทนอกแขนงของตนเองได้</small>
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
@endsection
