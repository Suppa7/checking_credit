<?php

namespace Database\Seeders;

use App\Models\SubjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectCategory =[
    ['id'=>1,'category_name'=>'ก. หมวดวิชาศึกษาทั่วไป','credit_needed'=>30],
    ['id'=>2,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>3,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>4,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>5,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>6,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>7,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>93],
    ['id'=>8,'category_name'=>'ค. หมวดวิชาเลือกเสรี','credit_needed'=>6],
    ['id'=>9,'category_name'=>'ก. หมวดวิชาศึกษาทั่วไป','credit_needed'=>24],
    ['id'=>10,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>11,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>12,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>13,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>14,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>15,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>16,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
    ['id'=>17,'category_name'=>'ข. หมวดวิชาเฉพาะ','credit_needed'=>99],
];

        foreach($subjectCategory as $item){
            SubjectCategory::create($item);
        }
    }
}
