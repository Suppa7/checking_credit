# Checking System - Project Context

## Overview
This is a Laravel 12 application designed as a **"Checking System"** for university or school students. Its primary purpose is to track students' academic progress, specifically matching the subjects they have registered for and passed against their required curriculum, majors, and sub-majors.

## Tech Stack
- **Framework:** Laravel 12.0
- **PHP Version:** ^8.2
- **Frontend/UI:** Laravel UI (Bootstrap/Vue/React depending on setup), Vite

## Key Entities & Database Structure
The database is structured around academic records and student profiles:
- **User & Roles:** Handles authentication. Users are assigned roles (e.g., `admin`, `user`).
- **Student:** Linked to a `User` profile. Stores student details and relationships to their `Curriculum`, `Major`, and `Submajor`.
- **Subject:** Represents academic courses (columns: `subject_code`, `subject_name`, `subject_credit`). Belongs to a specific `SubjectType` and optionally a `SubjectOwn` (owner department/faculty).
- **Curriculum & CurriculumSubject:** Defines the required courses for different academic programs and maps them to subject categories.
- **StudentRegist (Registration):** Tracks a student's enrollment in subjects and their completion status (e.g., `Pass`, `Fail`).
- **Major / Submajor / SubjectCategory / SubjectType / SubjectOwn:** Supporting entities classifying academic structures and subjects.

## Main Functionality & Flow
### 1. Authentication & Routing
- The project uses standard Laravel Auth.
- After login, the `HomeController` redirects users based on their role to either the Admin panel (`admin.index`) or the User panel (`user.index`).
- Routes are modularized into `routes/web.php`, `routes/admin.php`, and `routes/user.php`.

### 2. User (Student) Features
The `UserController` handles the student-facing features:
- **Detail View (`/user/detail/{id}`):** Retrieves the subjects the student has passed, filtered by the subject types required by their specific curriculum. The passed subjects are grouped by `subject_type_id` so the student can easily see their progress in each category (e.g., Core Subjects, Electives).
- **Show View (`/user/show/{id}/{type_id}`):** For a specific subject type, it displays both the **Passed Subjects** and the **Unpassed Subjects** (subjects in that category that the student has not yet passed).
- **Add Registered Subject (`/user/add-subject`, `/user/store-subject`):** Allows students to manually add their completed/registered subjects.
- **Edit Student Profile (`/user/edit-student`, `/user/update-student`):** Allows students to modify their personal details, major, and submajor assignments.

### 3. Admin Features
The admin panel is handled through dedicated RESTful resource controllers accessible under the `/admin` prefix. Admins have comprehensive CRUD (Create, Read, Update, Delete) access to manage the structural data of the university:
- **Entities Managed:** 
  - Subjects (`SubjectController`)
  - Curriculums (`CurriculumController`)
  - Curriculum Subjects (`CurriculumSubjectController`)
  - Majors (`MajorController`)
  - Submajors (`SubmajorController`)
  - Subject Types (`SubjectTypeController`)
  - Subject Categories (`SubjectCategoryController`)
  - Subject Owns (`SubjectOwnController`)

## Summary
The system acts as an academic credit-checking tool. By evaluating the `StudentRegist` records against the `Curriculum` requirements, it helps students and administrators instantly see which subjects have been completed and which structural requirements (by subject type and category) are still pending for graduation.
