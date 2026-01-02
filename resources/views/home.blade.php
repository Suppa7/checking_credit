@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="card-title fw-bold text-center">ตรวจสอบข้อมูล</h4>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 for="" class="form-label">รหัสนักศึกษา : {{Auth::user()->student_id}}</h5>
                    <h5 for="" class="form-label">ชื่อ : {{Auth::user()->student->student_name}}</h5>
                    <h5 for="" class="form-label">หลักสูตร : {{Auth::user()->student->major_name}}</h5>
                    <h5 for="" class="form-label">วิชาเอก : {{Auth::user()->student->submajor_name}}</h5>
                </div>
            </div>
            <div class="justify-content-center text-center">
                <a href="{{ route('detail',['id'=> Auth::user()->id]) }}" class="btn btn-success mt-3">กดเพื่อเช็กหน่วยกิต</a>
            </div>
        </div>
    </div>
</div>
@endsection
  