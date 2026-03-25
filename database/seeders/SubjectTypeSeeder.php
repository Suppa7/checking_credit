<?php

namespace Database\Seeders;

use App\Models\SubjectType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectType = [
            [
                'subject_category_id' => 1,
                'credit_needed' => 4,
                'type_name' => 'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 5,
                'type_name' => 'สาระที่ 2 ความเป็นพลเมืองและชีวิตที่สันติ'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 1,
                'type_name' => 'สาระที่ 3 การเป็นผู้ประกอบการ'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 4,
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 4,
                'type_name' => 'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 4,
                'type_name' => 'สาระที่ 6 ภาษาและการสื่อสาร'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 2,
                'type_name' => 'สาระที่ 7 สุนทรียศาสตร์และกีฬา'
            ],
            [
                'subject_category_id' => 1,
                'credit_needed' => 6,
                'type_name' => 'รายวิชาเลือก'
            ],
            [
                'subject_category_id' => 2,
                'credit_needed' => 39,
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_category_id' => 2,
                'credit_needed' => 30,
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_category_id' => 2,
                'credit_needed' => 9,
                'type_name' => 'วิชาชีพเลือก'
            ],
            [
                'subject_category_id' => 2,
                'credit_needed' => 15,
                'type_name' => 'วิชาโท'
            ],
            [
                'subject_category_id' => 4,
                'credit_needed' => 39,
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_category_id' => 4,
                'credit_needed' => 39,
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_category_id' => 4,
                'credit_needed' => 0,
                'type_name' => 'วิชาชีพเลือก'
            ],
            [
                'subject_category_id' => 4,
                'credit_needed' => 15,
                'type_name' => 'วิชาโท'
            ],
        ];
        foreach ($subjectType as $item) {
            SubjectType::create($item);
        }
    }
}
