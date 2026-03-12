<?php

namespace Database\Seeders;

use App\Models\SubjectOwn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectOwnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjectOwns = [
            [
                'major_id' => 1,
                'submajor_id' => 1,
            ],
            [
                'major_id' => 1,
                'submajor_id' => 2,
            ],
            [
                'major_id' => 1,
                'submajor_id' => 3,
            ],
            [
                'major_id' => 1,
                'submajor_id' => 4,
            ],
            [
                'major_id' => 1,
                'submajor_id' => 5,
            ],
            [
                'major_id' => 1,
                'submajor_id' => 6,
            ],
            [
                'major_id' => 1,
            ],
            [
                'major_id' => 2
            ]
        ];
        foreach($subjectOwns as $value) {
            SubjectOwn::create($value);
        }
    }
}
