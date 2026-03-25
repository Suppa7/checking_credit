<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $curriculum = [
            [ //1
                'program_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
                'curriculum_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
                'curriculum_year' => '2563',
            ],
            [ //2
                'program_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
                'curriculum_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต',
                'curriculum_year' => '2567',
            ],
            [ //3
                'program_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต(หลักสูตรนานาชาติ)',
                'curriculum_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต(หลักสูตรนานาชาติ)',
                'curriculum_year' => '2564',
            ],
            [ //4
                'program_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต(หลักสูตรนานาชาติ)',
                'curriculum_name' => 'หลักสูตรบริหารธุรกิจบัณฑิต(หลักสูตรนานาชาติ)',
                'curriculum_year' => '2568',
            ],
            [ //5
                'program_name' => 'หลักสูตรบัญชีบัณฑิต',
                'curriculum_name' => 'หลักสูตรบัญชีบัณฑิต',
                'curriculum_year' => '2564',
            ],
            [ //6
                'program_name' => 'หลักสูตรบัญชีบัณฑิต',
                'curriculum_name' => 'หลักสูตรบัญชีบัณฑิต',
                'curriculum_year' => '2568',
            ],
        ];

        foreach($curriculum as $item){
            Curriculum::create($item);
        }
    }
}
