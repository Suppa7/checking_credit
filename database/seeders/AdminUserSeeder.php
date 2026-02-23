<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'student_id' => 'admin',
            'role'       => 'admin',
            'password'   => Hash::make('12345678'), // เข้ารหัสผ่านให้เรียบร้อย
        ]);
    }
}
