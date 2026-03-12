@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="card-title fw-bold text-center">เมนูจัดการข้อมูล (Menu)</h4>
            
            @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <div class="d-grid gap-3 col-md-8 mx-auto py-4">
                        <!-- เช็กหน่วยกิต -->
                        <a href="{{ route('user.detail', ['id' => Auth::user()->id]) }}" class="btn btn-success btn-lg">
                            <i class="bi bi-card-checklist"></i> เช็กหน่วยกิต (Check Credits)
                        </a>
                        
                        <!-- เพิ่มวิชาที่ลงทะเบียน -->
                        <a href="{{ route('user.add_subject') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-journal-plus"></i> เพิ่มวิชาที่ลงทะเบียน (Add Registered Subject)
                        </a>
                        
                        <!-- แก้ไขข้อมูลนักศึกษา -->
                        <a href="{{ route('user.edit_student') }}" class="btn btn-warning btn-lg">
                            <i class="bi bi-person-gear"></i> แก้ไขข้อมูลนักศึกษา (Edit Student Info)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection