<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subject = [
            [
                'subject_code' => '001-102',
                'subject_name' => 'ศาสตร์พระราชากับการพัฒนาที่ยั่งยืน',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์',
            ],
            [
                'subject_code' => '388-100',
                'subject_name' => 'สุขภาวะเพื่อเพื่อนมนุษย์',
                'subject_credit' => '1',
                'type_name' => 'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์',
            ],
            [
                'subject_code' => '465-100',
                'subject_name' => 'ประโยชน์เพื่อนมนุษย์',
                'subject_credit' => '1',
                'type_name' => 'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์',
            ],
            [
                'subject_code' => '003-001G6',
                'subject_name' => 'ผู้นำจิตอาสาเพื่อการพัฒนาชุมชน',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์',
            ],
            [
                'subject_code' => '465-100',
                'subject_name' => 'พลเมืองที่ดี',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 2 ความเป็นพลเมืองและชีวิตที่สันติ'
            ],
            [
                'subject_code' => '477-101',
                'subject_name' => 'หลักการพื้นฐานระบบสารสนเทศ',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
        ];
        foreach($subject as $item){
            Subject::create($item);
        }
    }
}
