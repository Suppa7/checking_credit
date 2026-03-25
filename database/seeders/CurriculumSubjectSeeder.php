<?php

namespace Database\Seeders;

use App\Models\CurriculumSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumSubject = [
            [
                'curriculum_type_id'=>1,
                'subject_category_id'=>1
            ],
            [
                'curriculum_type_id'=>1,
                'subject_category_id'=>2
            ],
            [
                'curriculum_type_id'=>1,
                'subject_category_id'=>3
            ],
            [
                'curriculum_type_id'=>2,
                'subject_category_id'=>1
            ],
            [
                'curriculum_type_id'=>2,
                'subject_category_id'=>4
            ],
            [
                'curriculum_type_id'=>2,
                'subject_category_id'=>3
            ],
        ];
        foreach ($curriculumSubject as $value) {
            CurriculumSubject::create($value);
        }
    }
}
