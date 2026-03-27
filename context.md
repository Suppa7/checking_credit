# Checking System - Project Context

## Overview
This is a Laravel 12 application designed as a **"Checking System"** for university students. Its primary purpose is to track students' academic progress by matching registered/passed subjects against their curriculum requirements. The system supports multiple "tracks" or "types" within a single curriculum (e.g., Regular vs. Co-op).

## Tech Stack
- **Framework:** Laravel 12.0
- **PHP Version:** ^8.2
- **Frontend/UI:** Laravel UI (Bootstrap), Select2 for enhanced dropdowns, Vite.

## Key Entities & Database Structure
- **User & Roles:** Handles authentication and role assignment (`admin`, `user`).
- **Student:** Linked to a `User`. Stores relationships to `Curriculum`, `Major`, and `Submajor`.
- **Subject:** Represents courses with `subject_code`, `subject_name`, and `subject_credit`. Belongs to a `SubjectType` and `SubjectOwn`.
- **Curriculum:** Defines academic programs. Has many `CurriculumType` and `SubjectCurriculum`.
- **CurriculumType:** Defines specific tracks within a curriculum (e.g., "Regular track", "Co-op track"). Groups `CurriculumSubject` requirements.
- **SubjectCurriculum:** Pivot entity mapping `Subject` to `Curriculum`, defining which subjects are available in which curriculum.
- **CurriculumSubject:** Maps a `CurriculumType` to a `SubjectCategory`, defining the credit requirements for that category in that track.
- **SubmajorMeasure:** Defines specific credit requirements or "measures" for a `Submajor` within a `CurriculumType`.
- **StudentRegist:** Tracks a student's enrollment and completion status (`Pass`, `Fail`) for subjects.
- **Supporting Entities:** `Major`, `Submajor`, `SubjectCategory`, `SubjectType`, `SubjectOwn`.

## Main Functionality & Flow
### 1. Authentication & Role-Based Routing
- Users are redirected after login via `HomeController` based on their role:
    - `admin` -> `admin.index`
    - `user` -> `user.index`
- Routes are organized into `routes/web.php`, `routes/admin.php`, and `routes/user.php`.

### 2. User (Student) Features (`UserController`)
- **Dashboard (`/user/index`):** Displays progress cards for all `CurriculumType` tracks available in the student's curriculum. Shows total credits earned vs. needed and progress percentage.
- **Track Detail (`/user/detail/{id}`):** Displays breakdown of subjects by category for a selected `CurriculumType`. Allows filtering by `type_name`.
- **Category Show (`/user/show/{id}/{type_id}`):** Displays passed vs. unpassed subjects for a specific subject type within the context of the student's curriculum.
- **Registration Management:** Students can manually add subjects they've registered for and update their profile (name, major, submajor).

### 3. Admin Features
Admins manage the structural data via RESTful resource controllers:
- **Curriculum Management:** `CurriculumController` and `CurriculumTypeController` (to manage tracks and submajor measures).
- **Subject Association:** `CurriculumSubjectController` (linking categories to tracks) and `SubjectController`.
- **Classification Management:** CRUD for `Majors`, `Submajors`, `SubjectTypes`, `SubjectCategories`, and `SubjectOwns`.
- **User Management:** Managed via `UserManagementController`.

## Progress Tracking Logic
The system evaluates `StudentRegist` (status='Pass') against `CurriculumSubject` requirements. It groups subjects by `SubjectCategory` (via `SubjectType`) and calculates earned credits, capping them at the `credit_needed` for each category to provide an accurate percentage towards graduation requirements for a specific `CurriculumType`.
