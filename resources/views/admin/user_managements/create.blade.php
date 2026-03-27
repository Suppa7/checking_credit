@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user_managements.index') }}">จัดการผู้ใช้งาน</a></li>
    <li class="breadcrumb-item active" aria-current="page">เพิ่มผู้ใช้งาน</li>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">เพิ่มผู้ใช้งานใหม่</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.user_managements.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID / Username</label>
                            <input type="text" name="student_id" id="student_id" class="form-control @error('student_id') is-invalid @enderror" value="{{ old('student_id') }}" required>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-bold">ประเภทผู้ใช้งาน (Role)</label>
                            <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" onchange="toggleStudentFields()" required>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (นักศึกษา)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (ผู้ดูแลระบบ)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="student_fields" style="display: {{ old('role', 'user') == 'user' ? 'block' : 'none' }};">
                            <hr class="my-4">
                            <h6 class="fw-bold mb-3 text-primary">ข้อมูลนักศึกษา</h6>
                            
                            <div class="mb-3">
                                <label for="student_name" class="form-label">ชื่อ-นามสกุล</label>
                                <input type="text" name="student_name" id="student_name" class="form-control @error('student_name') is-invalid @enderror" value="{{ old('student_name') }}">
                                @error('student_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="curriculum_id" class="form-label">เล่มหลักสูตร</label>
                                <select name="curriculum_id" id="curriculum_id" class="form-select @error('curriculum_id') is-invalid @enderror">
                                    <option value="">-- เลือกเล่มหลักสูตร --</option>
                                    @foreach($curriculums as $curriculum)
                                        <option value="{{ $curriculum->id }}" {{ old('curriculum_id') == $curriculum->id ? 'selected' : '' }}>
                                            {{ $curriculum->major->major_name_thai }} ({{ $curriculum->curriculum_year }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('curriculum_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="major_id" class="form-label">หลักสูตร (Major)</label>
                                    <select name="major_id" id="major_id" class="form-select @error('major_id') is-invalid @enderror">
                                        <option value="">-- เลือกหลักสูตร --</option>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}" {{ old('major_id') == $major->id ? 'selected' : '' }}>
                                                {{ $major->major_name_thai }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('major_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="submajor_id" class="form-label">วิชาเอก (Submajor)</label>
                                    <select name="submajor_id" id="submajor_id" class="form-select @error('submajor_id') is-invalid @enderror">
                                        <option value="">-- ไม่มี/เลือก --</option>
                                        @foreach($submajors as $submajor)
                                            <option value="{{ $submajor->id }}" {{ old('submajor_id') == $submajor->id ? 'selected' : '' }}>
                                                {{ $submajor->submajor_name_thai }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('submajor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pb-2">
                            <a href="{{ route('admin.user_managements.index') }}" class="btn btn-light rounded-pill px-4">ยกเลิก</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleStudentFields() {
        const role = document.getElementById('role').value;
        const studentFields = document.getElementById('student_fields');
        studentFields.style.display = (role === 'user') ? 'block' : 'none';
        
        // Toggle required attributes if needed, but validation is handled in controller
    }
</script>
@endsection

