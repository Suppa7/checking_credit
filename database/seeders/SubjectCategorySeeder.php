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
            [
            'category_name' => 'ก. หมวดวิชาศึกษาทั่วไป',
            'credit_needed' => 30,
            ],
            [
            'category_name' => 'ข. หมวดวิชาเฉพาะ ',
            'credit_needed' => 93,
            ],
            [
            'category_name' => 'ค. หมวดวิชาเลือกเสร',
            'credit_needed' => 6,
            ],  
        ];

        foreach($subjectCategory as $item){
            SubjectCategory::create($item);
        }
    }
}
