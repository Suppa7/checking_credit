<?php

namespace Database\Seeders;

use App\Models\SubjectType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            MajorSeeder::class,
            SubmajorSeeder::class,
            SubjectOwnSeeder::class,
            UserSeeder::class,
            CurriculumSeeder::class,
            CurriculumSubjectSeeder::class,
            SubjectCategorySeeder::class,
            SubjectTypeSeeder::class,
            SubjectSeeder::class,
        ]);
    }
}
