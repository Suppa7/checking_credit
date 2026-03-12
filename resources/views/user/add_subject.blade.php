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
    .card-header-custom {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }
    .form-label {
        color: #2a5298;
        font-weight: 600;
    }
    .form-select {
        border-radius: 10px;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    .form-select:focus {
        border-color: #4facfe;
        box-shadow: 0 0 0 0.25rem rgba(79, 172, 254, 0.25);
    }
    .btn-submit {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.6rem 2rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 242, 254, 0.4);
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
                    <div class="card-header-custom text-center">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-journal-plus me-2"></i> เพิ่มวิชาที่ลงทะเบียน</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store_subject') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="subject_id" class="form-label fw-bold">เลือกวิชา</label>
                                <select class="form-select @error('subject_id') is-invalid @enderror" id="subject_id"
                                    name="subject_id" required>
                                    <option value="" disabled selected>-- กรุณาเลือกวิชา --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_code }}
                                            {{ $subject->subject_name }} ({{ $subject->subject_credit }} หน่วยกิต)</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-bold">สถานะ</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="" disabled selected>-- กรุณาเลือกสถานะ --</option>
                                    <option value="Pass">Pass (ผ่าน)</option>
                                    <option value="Not Pass">Not Pass (ไม่ผ่าน/ยังเรียนไม่จบ)</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('user.index') }}" class="btn btn-back">
                                    <i class="bi bi-arrow-left"></i> ย้อนกลับ
                                </a>
                                <button type="submit" class="btn btn-submit">
                                    <i class="bi bi-save"></i> บันทึกข้อมูล
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection