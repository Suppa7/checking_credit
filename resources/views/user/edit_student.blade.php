@extends('layouts.app')

@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            color: #333;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .card-header-warning {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .form-label {
            color: #2a5298;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #fda085;
            box-shadow: 0 0 0 0.25rem rgba(253, 160, 133, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(253, 160, 133, 0.4);
            color: white;
        }

        .btn-back {
            background: white;
            color: #6c757d;
            border: 1px solid #dee2e6;
            font-weight: 600;
            padding: 0.6rem 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #f8f9fa;
            color: #343a40;
        }
    </style>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card glass-card">
                    <div class="card-header-warning text-center">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-person-gear"></i> แก้ไขข้อมูลนักศึกษา</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update_student') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="student_name" class="form-label fw-bold">ชื่อ-นามสกุล</label>
                                <input type="text" class="form-control @error('student_name') is-invalid @enderror"
                                    id="student_name" name="student_name"
                                    value="{{ old('student_name', $student->student_name) }}" required>
                                @error('student_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="major_id" class="form-label fw-bold">สาขาวิชาหลัก</label>
                                <select class="form-select @error('major_id') is-invalid @enderror" id="major_id"
                                    name="major_id" required>
                                    <option value="" disabled>-- กรุณาเลือกสาขาวิชา --</option>
                                    @foreach($majors as $major)
                                        <option value="{{ $major->id }}" {{ (old('major_id', $student->major_id) == $major->id) ? 'selected' : '' }}>
                                            {{ $major->major_name_thai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('major_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="submajor_id" class="form-label fw-bold">วิชาเอก (ถ้ามี)</label>
                                <select class="form-select @error('submajor_id') is-invalid @enderror" id="submajor_id"
                                    name="submajor_id">
                                    <option value="">-- ไม่มี --</option>
                                    @foreach($submajors as $submajor)
                                        <!-- Only show submajors conceptually. Since we don't have JS to filter by major, we list all currently. -->
                                        <option value="{{ $submajor->id }}" {{ (old('submajor_id', $student->submajor_id) == $submajor->id) ? 'selected' : '' }}>
                                            {{ $submajor->submajor_name_thai }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('submajor_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('user.index') }}" class="btn btn-back">
                                    <i class="bi bi-arrow-left"></i> ย้อนกลับ
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-save"></i> บันทึกการแก้ไข
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection