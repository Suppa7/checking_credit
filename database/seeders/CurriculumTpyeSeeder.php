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
    [ //1
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ',
        'submajor_id'=>1
    ],
    [ //2
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ',
        'submajor_id'=>1
    ],
    [ //3
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ',
        'submajor_id'=>2
    ],
    [ //4
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ',
        'submajor_id'=>2
    ],
    [ //5
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ',
        'submajor_id'=>3
    ],
    [ //6
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ',
        'submajor_id'=>3
    ],
    [ //7
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ วิชาเอกเดี่ยว',
        'submajor_id'=>4
    ],
    [ //8
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>4
    ],
    [ //9
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ วิชาเอกเดี่ยว',
        'submajor_id'=>4
    ],
    [ //10
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ วิชาเอกและวิชาโท',
        'submajor_id'=>4
    ],
    [ //11
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ',
        'submajor_id'=>5
    ],
    [ //12
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ',
        'submajor_id'=>5
    ],
    [ //13
        'curriculum_id'=>1,
        'type_name'=>'แบบปกติ',
        'submajor_id'=>6
    ],
    [ //14
        'curriculum_id'=>1,
        'type_name'=>'แบบสหกิจ',
        'submajor_id'=>6
    ],

    [ //15
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกเดี่ยว',
        'submajor_id'=>1
    ],
    [ //16
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>1
    ],
    [ //17
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกเดี่ยว',
        'submajor_id'=>1
    ],
    [ //18
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>2
    ],
    [ //19
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกและวิชาโท',
        'submajor_id'=>2
    ],
    [ //20
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>3
    ],
    [ //21
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกและวิชาโท',
        'submajor_id'=>3
    ],
    [ //22
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกเดี่ยว',
        'submajor_id'=>4
    ],
    [ //23
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>4
    ],
    [ //24
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกเดี่ยว',
        'submajor_id'=>4
    ],
    [ //25
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกและวิชาโท',
        'submajor_id'=>4
    ],
    [ //26
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกเดี่ยว',
        'submajor_id'=>5
    ],
    [ //27
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกเดี่ยว',
        'submajor_id'=>5
    ],
    [ //28
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกเดี่ยว',
        'submajor_id'=>6
    ],
    [ //29
        'curriculum_id'=>2,
        'type_name'=>'แบบปกติ วิชาเอกและวิชาโท',
        'submajor_id'=>6
    ],
    [ //30
        'curriculum_id'=>2,
        'type_name'=>'แบบสหกิจ วิชาเอกเดี่ยว',
        'submajor_id'=>6
    ],
            
        ];
        foreach ($curriculumSubject as $value) {
            CurriculumType::create($value);
        }
    }
}
