@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">หน้าแรก</a></li>
    <li class="breadcrumb-item active" aria-current="page">เมนูจัดการข้อมูล</li>
@endsection

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="d-flex align-items-center mb-4 pb-2 border-bottom">
                    <span class="fs-1 me-3">⚙️</span>
                    <div>
                        <h2 class="mb-0 fw-bold" style="color: #2c3e50;">Admin Dashboard</h2>
                        <p class="text-muted mb-0">จัดการข้อมูลพื้นฐานของระบบตรวจสอบหน่วยกิต</p>
                    </div>
                </div>

                <div class="row g-4">
                    {{-- Subject --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-3 mx-auto">
                                    <span class="fs-1">📚</span>
                                </div>
                                <h5 class="card-title fw-bold">รายวิชา (Subject)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการข้อมูลรายวิชาทั้งหมด</p>
                                <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-primary rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Curriculum --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-success bg-opacity-10 text-success mb-3 mx-auto">
                                    <span class="fs-1">🎓</span>
                                </div>
                                <h5 class="card-title fw-bold">เล่มหลักสูตร (Curriculum)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการข้อมูลโครงสร้างเล่มหลักสูตร</p>
                                <a href="{{ route('admin.curriculums.index') }}" class="btn btn-outline-success rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Major --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-info bg-opacity-10 text-info mb-3 mx-auto">
                                    <span class="fs-1">🏛️</span>
                                </div>
                                <h5 class="card-title fw-bold">หลักสูตร (Major)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการข้อมูลหลักสูตร</p>
                                <a href="{{ route('admin.majors.index') }}" class="btn btn-outline-info rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Submajor --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-warning bg-opacity-10 text-warning mb-3 mx-auto" style="color: #d39e00 !important;">
                                    <span class="fs-1">🔖</span>
                                </div>
                                <h5 class="card-title fw-bold">วิชาเอก (Submajor)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการข้อมูลวิชาเอก</p>
                                <a href="{{ route('admin.submajors.index') }}" class="btn btn-outline-warning rounded-pill px-4 mt-2 w-100 fw-semibold text-dark">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Curriculum Subject --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-danger bg-opacity-10 text-danger mb-3 mx-auto">
                                    <span class="fs-1">📑</span>
                                </div>
                                <h5 class="card-title fw-bold">วิชาในหลักสูตร</h5>
                                <p class="card-text text-muted flex-grow-1 small">ผูกรายวิชาเข้ากับหลักสูตรต่างๆ</p>
                                <a href="{{ route('admin.curriculum_subjects.index') }}" class="btn btn-outline-danger rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Subject Type --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-secondary bg-opacity-10 text-secondary mb-3 mx-auto">
                                    <span class="fs-1">📂</span>
                                </div>
                                <h5 class="card-title fw-bold">หมวดวิชา (Subject Type)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการหมวดหมู่รายวิชา เช่น แกน เลือก</p>
                                <a href="{{ route('admin.subject_types.index') }}" class="btn btn-outline-secondary rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Subject Own --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-dark bg-opacity-10 text-dark mb-3 mx-auto">
                                    <span class="fs-1">🏢</span>
                                </div>
                                <h5 class="card-title fw-bold">เจ้าของวิชา (Subject Own)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการภาควิชา/คณะเจ้าของวิชา</p>
                                <a href="{{ route('admin.subject_owns.index') }}" class="btn btn-outline-dark rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Subject Category --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-purple bg-opacity-10 text-purple mb-3 mx-auto">
                                    <span class="fs-1">🏷️</span>
                                </div>
                                <h5 class="card-title fw-bold">กลุ่มวิชา (Category)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการกลุ่มย่อยของรายวิชา</p>
                                <a href="{{ route('admin.subject_categories.index') }}" class="btn rounded-pill px-4 mt-2 w-100 fw-semibold btn-outline-custom-purple">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- User Management --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-dark bg-opacity-10 text-dark mb-3 mx-auto">
                                    <span class="fs-1">👤</span>
                                </div>
                                <h5 class="card-title fw-bold">ผู้ใช้งาน (Users)</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการบัญชีผู้ใช้งานและสิทธิ์</p>
                                <a href="{{ route('admin.user_managements.index') }}" class="btn btn-outline-dark rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>

                    {{-- Curriculum Type --}}
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card h-100 shadow-sm border-0 rounded-4 hover-lift">
                            <div class="card-body text-center p-4 d-flex flex-column">
                                <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-3 mx-auto">
                                    <span class="fs-1">📋</span>
                                </div>
                                <h5 class="card-title fw-bold">รูปแบบหลักสูตร</h5>
                                <p class="card-text text-muted flex-grow-1 small">จัดการรูปแบบหลักสูตรแต่ละเล่ม</p>
                                <a href="{{ route('admin.curriculum_types.index') }}" class="btn btn-outline-primary rounded-pill px-4 mt-2 w-100 fw-semibold">จัดการ</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <style>
        .hover-lift {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .bg-purple {
            background-color: #6f42c1;
        }
        .text-purple {
            color: #6f42c1;
        }
        .btn-outline-custom-purple {
            color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-outline-custom-purple:hover {
            background-color: #6f42c1;
            color: white;
        }
    </style>
@endsection
