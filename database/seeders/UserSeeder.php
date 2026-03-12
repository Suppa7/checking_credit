<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'student_id' => '6510510376',
            'password' => Hash::make('12345678'),
            'role' => 'user',
        ]);

        $user = User::where('student_id', '6510510376')->first();
        
        Student::create([
            'user_id' => $user->id,
            'student_name' => 'สวรรยา แก้วประดิษฐ์',
            'curriculum_id' => 1,
            'major_id' => 1,
            'submajor_id' => 1,
        ]);
    }
}
