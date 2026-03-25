<?php

namespace Database\Seeders;

use App\Models\CurriculumType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumTpyeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculumSubject = [
            [
                'curriculum_id'=>1,
                'type_name'=>'แผนปกติ'
            ],
            [
                'curriculum_id'=>1,
                'type_name'=>'แผนสหกิจศึกษา'
            ],
            [
                'curriculum_id'=>2,
                'type_name'=>"แผนปกติ"
            ],
            [
                'curriculum_id'=>2,
                'type_name'=>"แผนสหกิจศึกษา"
            ],
            [
                'curriculum_id'=>3,
                'type_name'=>"แผนปกติ"
            ],
            [
                'curriculum_id'=>3,
                'type_name'=>"แผนสหกิจศึกษา"
            ],
            [
                'curriculum_id'=>4,
                'type_name'=>"แผนปกติ"
            ],
            [
                'curriculum_id'=>4,
                'type_name'=>"แผนสหกิจศึกษา"
            ],
            [
                'curriculum_id'=>5,
                'type_name'=>"แผนปกติรูปแบบที่ 1"
            ],
            [
                'curriculum_id'=>5,
                'type_name'=>"แผนสหกิจศึกษารูปแบบที่ 1"
            ],
            [
                'curriculum_id'=>5,
                'type_name'=>"แผนปกติรูปแบบที่ 2"
            ],
            [
                'curriculum_id'=>5,
                'type_name'=>"แผนสหกิจศึกษารูปแบบที่ 2"
            ]
        ];
        foreach ($curriculumSubject as $value) {
            CurriculumType::create($value);
        }
    }
}
