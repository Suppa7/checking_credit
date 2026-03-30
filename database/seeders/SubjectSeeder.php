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
                'subject_code' => '895-001',
                'subject_name' => 'พลเมืองที่ดี',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 2 ความเป็นพลเมืองและชีวิตที่สันติ'
            ],
            [
                'subject_code' => '950-102',
                'subject_name' => 'ชีวิตที่ดี',
                'subject_credit' => '3',
                'type_name' => 'สาระที่ 2 ความเป็นพลเมืองและชีวิตที่สันติ'
            ],
            [
                'subject_code' => '001-103',
                'subject_name' => 'ไอเดียสู่การเป็นผู้ประกอบการ',
                'subject_credit' => '3',
                'type_name' => 'สาระที่ 3 การเป็นผู้ประกอบการ'
            ],
            [
                'subject_code' => '200-103',
                'subject_name' => 'ชีวิตยุคใหม่ด้วยใจสีเขียว',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_code' => '315-201',
                'subject_name' => 'ชีวิตแห่งอนาคต',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_code' => '820-100',
                'subject_name' => 'รักษ์โลก รักษ์เรา',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_code' => '200-107',
                'subject_name' => 'การเชื่อมต่อสรรพสิ่งเพื่อชีวิตยุคดิจิทัล',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_code' => '345-104',
                'subject_name' => 'รู้ทันเทคโนโลยีดิจิทัล',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'
            ],
            [
                'subject_code' => '315-100',
                'subject_name' => 'คำนวณศิลป์ (The Art of Computing)',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'
            ],
            [
                'subject_code' => '315-202',
                'subject_name' => 'การคิดกับการใช้เหตุผล',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'
            ],
            [
                'subject_code' => '895-011',
                'subject_name' => 'การคิดเพื่อสร้างสุข',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'
            ],
            [
                'subject_code' => '895-012',
                'subject_name' => 'การคิดเชิงบวก',
                'subject_credit' => '2',
                'type_name' => 'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'
            ],
            [
                'subject_code' => '347-203',
                'subject_name' => 'สถิติพื้นฐานสำหรับธุรกิจและการประยุกต์ใช้ (Basic Statistics for Business and Applications)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-101',
                'subject_name' => 'หลักการตลาด (Principles of Marketing)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-102',
                'subject_name' => 'การจัดการทรัพยากรมนุษย์ (Human Resource Management)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-103',
                'subject_name' => 'หลักการเงิน (Principles of Finance)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-104',
                'subject_name' => 'การจัดการการผลิตและการดำเนินงาน (Production and Operation Management)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-201',
                'subject_name' => 'ทักษะการติดต่อสื่อสารทางธุรกิจ (Business Communication Skills)',
                'subject_credit' => '2',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-301',
                'subject_name' => 'ธุรกิจอัจฉริยะและการวิเคราะห์ข้อมูลเชิงธุรกิจ (Business Intelligence and Data Analytics)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '460-401',
                'subject_name' => 'การจัดการเชิงกลยุทธ์ (Strategic Management)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '464-101',
                'subject_name' => 'การบัญชีการเงินเบื้องต้น (Fundamental Financial Accounting)',
                'subject_credit' => '3',
                'type_name' => 'กลุ่มวิชาแกน'
            ],
            [
                'subject_code' => '477-101',
                'subject_name' => 'หลักการพื้นฐานระบบสารสนเทศ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-302',
                'subject_name' => 'เทคโนโลยีแพลตฟอร์มสําหรับคลาวด์',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-102',
                'subject_name' => 'ตรรกะของการใช้โปรแกรมและโครงสร้างข้อมูล ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-201',
                'subject_name' => 'การเขียนโปรแกรมเบื้องต้นทางธุรกิจ ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-301',
                'subject_name' => 'การพัฒนาเว็บขั้นสมบูรณ์ ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-303',
                'subject_name' => 'การวิเคราะห์และออกแบบระบบสารสนเทศทางธุรกิจ ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-202',
                'subject_name' => 'การจัดการฐานข้อมูล',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-203',
                'subject_name' => 'เครือข่ายคอมพิวเตอร์และความมั่นคงทางไซเบอร์',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
            [
                'subject_code' => '477-401',
                'subject_name' => 'สัมมนาระบบสารสนเทศทางธุรกิจ',
                'subject_credit' => '3',
                'type_name' => 'วิชาชีพบังคับ'
            ],
        ];
        foreach ($subject as $item) {
            Subject::create($item);
        }
    }
}
