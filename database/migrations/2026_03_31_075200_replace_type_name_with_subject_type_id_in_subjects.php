<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Add subject_type_id column
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('subject_type_id')->nullable()->after('subject_credit');
        });

        // Step 2: Migrate data — map type_name to subject_type_id
        $subjects = DB::table('subjects')->whereNotNull('type_name')->get();
        foreach ($subjects as $subject) {
            $subjectType = DB::table('subject_types')->where('type_name', $subject->type_name)->first();
            if ($subjectType) {
                DB::table('subjects')->where('id', $subject->id)->update([
                    'subject_type_id' => $subjectType->id,
                ]);
            }
        }

        // Step 3: Drop type_name column
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('type_name');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->string('type_name')->nullable()->after('subject_credit');
        });

        // Migrate data back
        $subjects = DB::table('subjects')->whereNotNull('subject_type_id')->get();
        foreach ($subjects as $subject) {
            $subjectType = DB::table('subject_types')->where('id', $subject->subject_type_id)->first();
            if ($subjectType) {
                DB::table('subjects')->where('id', $subject->id)->update([
                    'type_name' => $subjectType->type_name,
                ]);
            }
        }

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropColumn('subject_type_id');
        });
    }
};
