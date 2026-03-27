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
                'major_id' => 1,
                'curriculum_year' => '2563',
            ],
            [ //2
                'major_id' => 1,
                'curriculum_year' => '2567',
            ],
            [ //3
                'major_id' => 2,
                'curriculum_year' => '2564',
            ],
            [ //4
                'major_id' => 2,
                'curriculum_year' => '2568',
            ],
            [ //5
                'major_id' => 3,
                'curriculum_year' => '2564',
            ],
            [ //6
                'major_id' => 3,
                'curriculum_year' => '2568',
            ],
        ];

        foreach($curriculum as $item){
            Curriculum::create($item);
        }
    }
}
