<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = [
            [
                'major_id' => '001',
                'major_name_thai' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
            ],
            [
                'major_id' => '002',
                'major_name_thai' => 'หลักสูตรบริหารธุรกิจบัณฑิต(หลักสูตรนานาชาติ)',
            ],
            [
                'major_id' => '003',
                'major_name_thai' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
            ],
            [
                'major_id' => '004',
                'major_name_thai' => 'หลักสูตรรัฐประศาสนศาสตรบัณฑิต',
            ],
        ];

        foreach ($major as $major) {
            Major::create($major);
        }
    }
}
