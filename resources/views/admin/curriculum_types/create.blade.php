@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.curriculum_types.index') }}">จัดการรูปแบบหลักสูตร</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มรูปแบบหลักสูตร</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">เพิ่มรูปแบบหลักสูตรใหม่</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.curriculum_types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="curriculum_id" class="form-label">เล่มหลักสูตร (Curriculum)</label>
                            <select name="curriculum_id" id="curriculum_id" class="form-select @error('curriculum_id') is-invalid @enderror" required>
                                <option value="">-- เลือกเล่มหลักสูตร --</option>
                                @foreach($curriculums as $curriculum)
                                    <option value="{{ $curriculum->id }}" {{ old('curriculum_id') == $curriculum->id ? 'selected' : '' }}>
                                        {{ $curriculum->program_name }} - {{ $curriculum->curriculum_name }} ({{ $curriculum->curriculum_year }})
                                    </option>
                                @endforeach
                            </select>
                            @error('curriculum_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_name" class="form-label">ชื่อรูปแบบ (Type Name)</label>
                            <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror" value="{{ old('type_name') }}" placeholder="เช่น แผน ก แบบ ก2" required>
                            @error('type_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.curriculum_types.index') }}" class="btn btn-secondary">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
