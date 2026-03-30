# Checking System - Project Context

## Overview
This is a Laravel 12 application designed as a **"Checking System"** for university students at PSU. Its primary purpose is to track students' academic progress by matching registered/passed subjects against their curriculum requirements. The system supports multiple "tracks" or "types" within a single curriculum (e.g., Regular vs. Co-op), catering to different academic paths.

## Tech Stack
- **Framework:** Laravel 12.0
- **PHP Version:** ^8.2
- **Frontend/UI:** Laravel UI (Bootstrap), Select2 for enhanced dropdowns, Vite.
- **Icons:** Bootstrap Icons.

## Key Entities & Database Structure
- **User & Roles:** Handles authentication and role assignment (`admin`, `user`).
- **Student:** Linked to a `User`. Stores relationships to `Curriculum`, `Major`, and `Submajor`.
- **Subject:** Represents courses with `subject_code`, `subject_name`, and `subject_credit`. Belongs to a `SubjectType` and `SubjectOwn`.
- **Curriculum:** Defines academic programs. Has many `CurriculumType` (tracks) and `SubjectCurriculum` (explicit associations).
- **CurriculumType:** Defines specific tracks within a curriculum (e.g., "Regular track", "Co-op track"). Now includes a `submajor_id` to link a track directly to a specific submajor when the curriculum's major is generic.
- **CurriculumSubject:** Links a `CurriculumType` to a `SubjectCategory`, defining credit requirements for that category in that specific track.
- **SubjectCategory:** High-level grouping of subjects (e.g., "General Education", "Major Requirements"). Defines `credit_needed`.
- **SubjectType:** More granular grouping under a category (e.g., "Language", "Science"). Linked to `SubjectCategory`.
- **SubjectCurriculum:** Pivot table for explicit associations between `Subject` and `Curriculum`.
- **SubmajorMeasure:** Defines whether a `Submajor` is "allowed" to take any elective or is restricted to subjects owned by their submajor within a `CurriculumType`.
- **StudentRegist:** Tracks a student's enrollment and completion status (`Pass`, `Fail`) for subjects.
- **Supporting Entities:** `Major`, `Submajor`, and `SubjectOwn` (defines which submajor owns a subject).

## Main Functionality & Flow
### 1. Authentication & Role-Based Routing
- Users are redirected after login via `HomeController` based on their role:
    - `admin` -> `admin.index`
    - `user` -> `user.index`
- Routes are organized into `routes/web.php`, `routes/admin.php`, and `routes/user.php`.

### 2. User (Student) Features (`UserController`)
- **Dashboard (`/user/index`):** Displays progress cards for all available tracks in the student's curriculum, showing total credits earned vs. needed.
- **Track Selection:** A modal using **Select2** allows students to choose a specific track (Curriculum Type) to view detailed progress.
- **Track Detail (`/user/detail/{id}`):** Provides a breakdown by category. Implements **dynamic elective filtering**: if `SubmajorMeasure` is not 'allowed', only subjects owned by the student's submajor are shown and counted for "Major Elective" (วิชาชีพเลือก).
- **Category Show (`/user/show/{id}/{type_id}`):** Lists passed and unpassed subjects within a category, filtered by the student's curriculum via `SubjectCurriculum`.
- **Registration Management:** Students can add registered subjects and update their profile.

### 3. Admin Features
Admins manage structure and users via RESTful controllers:
- **Curriculum & Track Management:** `CurriculumController` (includes dedicated views to review curriculum structures and subjects), `CurriculumTypeController`, and `SubmajorMeasureController`.
- **Subject Association:** Managed explicitly via `SubjectController` and `CurriculumSubjectController`.
- **Classification Management:** CRUD for `Majors`, `Submajors`, `SubjectTypes`, `SubjectCategories`, and `SubjectOwns`.
- **User Management:** Managed via user management controllers to handle user accounts and roles.

## Progress Tracking Logic
The system evaluates `StudentRegist` (status='Pass') against `CurriculumSubject` requirements. Credits are grouped by `SubjectCategory` and capped at the `credit_needed` for each category. 
- **Dynamic Elective Filtering:** For "Major Elective" (วิชาชีพเลือก) subjects, the logic checks `SubmajorMeasure`. If a submajor is not globally "allowed" to take all electives in a given track, the student only sees and receives credit for subjects specifically owned (`SubjectOwn`) by their submajor.
