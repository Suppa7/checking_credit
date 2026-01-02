<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ใช้ Raw SQL เพราะการเปลี่ยน String -> Int ใน Postgres ต้องระบุวิธีแปลง (USING)
        DB::statement('ALTER TABLE curriculum_subjects ALTER COLUMN curriculum_id TYPE bigint USING curriculum_id::bigint');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE curriculum_subjects ALTER COLUMN curriculum_id TYPE varchar(255)');
    }
};
