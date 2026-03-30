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
    [ 'id'=>1,'subject_category_id'=>1,'credit_needed'=>4,'type_name'=>'สาระที่ 1 ศาสตร์พระราชาและประโยชน์เพื่อนมนุษย์'],
    [ 'id'=>2,'subject_category_id'=>1,'credit_needed'=>5,'type_name'=>'สาระที่ 2 ความเป็นพลเมืองและชีวิตที่สันติ'],
    [ 'id'=>3,'subject_category_id'=>1,'credit_needed'=>1,'type_name'=>'สาระที่ 3 การเป็นผู้ประกอบการ'],
    [ 'id'=>4,'subject_category_id'=>1,'credit_needed'=>4,'type_name'=>'สาระที่ 4 การอยู่อย่างรู้เท่าทันและการรู้ดิจิทัล'],
    [ 'id'=>5,'subject_category_id'=>1,'credit_needed'=>4,'type_name'=>'สาระที่ 5 การคิดเชิงระบบการคิดเชิงตรรกะและตัวเลข'],
    [ 'id'=>6,'subject_category_id'=>1,'credit_needed'=>4,'type_name'=>'สาระที่ 6 ภาษาและการสื่อสาร'],
    [ 'id'=>7,'subject_category_id'=>1,'credit_needed'=>2,'type_name'=>'สาระที่ 7 สุนทรียศาสตร์และกีฬา'],
    [ 'id'=>8,'subject_category_id'=>1,'credit_needed'=>6,'type_name'=>'รายวิชาเลือก'],

    [ 'id'=>9,'subject_category_id'=>2,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>10,'subject_category_id'=>3,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>11,'subject_category_id'=>4,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>12,'subject_category_id'=>5,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>13,'subject_category_id'=>6,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>14,'subject_category_id'=>7,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>15,'subject_category_id'=>8,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>16,'subject_category_id'=>9,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>17,'subject_category_id'=>10,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>18,'subject_category_id'=>11,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>19,'subject_category_id'=>12,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>20,'subject_category_id'=>13,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>21,'subject_category_id'=>14,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>22,'subject_category_id'=>15,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาแกน'],

    [ 'id'=>23,'subject_category_id'=>2,'credit_needed'=>30,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>24,'subject_category_id'=>3,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>25,'subject_category_id'=>4,'credit_needed'=>30,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>26,'subject_category_id'=>5,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>27,'subject_category_id'=>6,'credit_needed'=>30,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>28,'subject_category_id'=>7,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>29,'subject_category_id'=>8,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>30,'subject_category_id'=>9,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>31,'subject_category_id'=>10,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>32,'subject_category_id'=>11,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>33,'subject_category_id'=>12,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>34,'subject_category_id'=>13,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>35,'subject_category_id'=>14,'credit_needed'=>30,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>36,'subject_category_id'=>15,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],

    [ 'id'=>37,'subject_category_id'=>2,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>38,'subject_category_id'=>4,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>39,'subject_category_id'=>6,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>40,'subject_category_id'=>8,'credit_needed'=>21,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>41,'subject_category_id'=>9,'credit_needed'=>6,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>42,'subject_category_id'=>10,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>43,'subject_category_id'=>12,'credit_needed'=>21,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>44,'subject_category_id'=>13,'credit_needed'=>18,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>45,'subject_category_id'=>14,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],

    [ 'id'=>46,'subject_category_id'=>2,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>47,'subject_category_id'=>3,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>48,'subject_category_id'=>4,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>49,'subject_category_id'=>5,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>50,'subject_category_id'=>6,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>51,'subject_category_id'=>7,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>52,'subject_category_id'=>9,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>53,'subject_category_id'=>11,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>54,'subject_category_id'=>14,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>55,'subject_category_id'=>15,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],

    [ 'id'=>56,'subject_category_id'=>16,'credit_needed'=>6,'type_name'=>'วิชาเลือกเสรี'],

    [ 'id'=>57,'subject_category_id'=>17,'credit_needed'=>4,'type_name'=>'GE 1 ภาษาและการสื่อสาร'],
    [ 'id'=>58,'subject_category_id'=>17,'credit_needed'=>4,'type_name'=>'GE 2 การพัฒนาความคิด'],
    [ 'id'=>59,'subject_category_id'=>17,'credit_needed'=>2,'type_name'=>'GE 3 การคิดแบบผู้ประกอบการ'],
    [ 'id'=>60,'subject_category_id'=>17,'credit_needed'=>2,'type_name'=>'GE 4 การใช้เทคโนโลยีดิจิทัล'],
    [ 'id'=>61,'subject_category_id'=>17,'credit_needed'=>2,'type_name'=>'GE 5 สุขภาวะแบบองค์รวม'],
    [ 'id'=>62,'subject_category_id'=>17,'credit_needed'=>2,'type_name'=>'GE 6 จิตสาธารณะและการพัฒนาที่ยั่งยืน'],
    [ 'id'=>63,'subject_category_id'=>17,'credit_needed'=>2,'type_name'=>'GE 7 การปรับตัวให้เข้ากับพลวัตของโลก'],
    [ 'id'=>64,'subject_category_id'=>17,'credit_needed'=>6,'type_name'=>'GE 8 รายวิชาเลือกในหมวดวิชาศึกษาทั่วไป'],

    [ 'id'=>65,'subject_category_id'=>18,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>66,'subject_category_id'=>19,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>67,'subject_category_id'=>20,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>68,'subject_category_id'=>21,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>69,'subject_category_id'=>22,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>70,'subject_category_id'=>23,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>71,'subject_category_id'=>24,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>72,'subject_category_id'=>25,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>73,'subject_category_id'=>26,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>74,'subject_category_id'=>27,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>75,'subject_category_id'=>28,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>76,'subject_category_id'=>29,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>77,'subject_category_id'=>30,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>78,'subject_category_id'=>31,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>79,'subject_category_id'=>32,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],
    [ 'id'=>80,'subject_category_id'=>33,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาแกน'],

    [ 'id'=>81,'subject_category_id'=>18,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>82,'subject_category_id'=>19,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>83,'subject_category_id'=>20,'credit_needed'=>42,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>84,'subject_category_id'=>21,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>85,'subject_category_id'=>22,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>86,'subject_category_id'=>23,'credit_needed'=>30,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>87,'subject_category_id'=>24,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>88,'subject_category_id'=>25,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>89,'subject_category_id'=>26,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>90,'subject_category_id'=>27,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>91,'subject_category_id'=>28,'credit_needed'=>39,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>92,'subject_category_id'=>29,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>93,'subject_category_id'=>30,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>94,'subject_category_id'=>31,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>95,'subject_category_id'=>32,'credit_needed'=>33,'type_name'=>'กลุ่มวิชาชีพบังคับ'],
    [ 'id'=>96,'subject_category_id'=>33,'credit_needed'=>36,'type_name'=>'กลุ่มวิชาชีพบังคับ'],

    [ 'id'=>97,'subject_category_id'=>18,'credit_needed'=>21,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>98,'subject_category_id'=>19,'credit_needed'=>6,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>99,'subject_category_id'=>20,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>100,'subject_category_id'=>21,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>101,'subject_category_id'=>22,'credit_needed'=>3,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>102,'subject_category_id'=>23,'credit_needed'=>12,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>103,'subject_category_id'=>24,'credit_needed'=>6,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>104,'subject_category_id'=>25,'credit_needed'=>21,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>105,'subject_category_id'=>26,'credit_needed'=>6,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>106,'subject_category_id'=>27,'credit_needed'=>18,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>107,'subject_category_id'=>28,'credit_needed'=>3,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>108,'subject_category_id'=>29,'credit_needed'=>24,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>109,'subject_category_id'=>30,'credit_needed'=>24,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>110,'subject_category_id'=>31,'credit_needed'=>24,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>111,'subject_category_id'=>32,'credit_needed'=>9,'type_name'=>'กลุ่มวิชาชีพเลือก'],
    [ 'id'=>112,'subject_category_id'=>33,'credit_needed'=>21,'type_name'=>'กลุ่มวิชาชีพเลือก'],

    [ 'id'=>113,'subject_category_id'=>19,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>114,'subject_category_id'=>21,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>115,'subject_category_id'=>22,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>116,'subject_category_id'=>23,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>117,'subject_category_id'=>24,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>118,'subject_category_id'=>26,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>119,'subject_category_id'=>28,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],
    [ 'id'=>120,'subject_category_id'=>32,'credit_needed'=>15,'type_name'=>'กลุ่มวิชาชีพโท'],

    [ 'id'=>121,'subject_category_id'=>34,'credit_needed'=>6,'type_name'=>'วิชาเลือกเสรี']
        ];
        foreach ($subjectType as $item) {
            SubjectType::create($item);
        }
    }
}
