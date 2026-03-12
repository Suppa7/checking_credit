<?php

namespace Database\Seeders;

use App\Models\Submajor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submajor = [
            [
                'submajor_id' => '001',
                'submajor_name_thai' => 'ระบบสารสนเทศทางธุรกิจ',
                'major_id' => 1
            ],
            [
                'submajor_id' => '002',
                'submajor_name_thai' => 'การเงินและการลงทุน',
                'major_id' => 1
            ],
            [
                'submajor_id' => '003',
                'submajor_name_thai' => 'การตลาดและการสื่อสาร',
                'major_id' => 1
            ],
            [
                'submajor_id' => '004',
                'submajor_name_thai' => 'การจัดการทรัพยากรมนุษย์',
                'major_id' => 1
            ],
            [
                'submajor_id' => '005',
                'submajor_name_thai' => 'การจัดการโลจิสติกส์และโซ่อุปทาน',
                'major_id' => 1
            ],
            [
                'submajor_id' => '006',
                'submajor_name_thai' => 'การจัดการไมซ์',
                'major_id' => 1
            ],
        ];

        foreach ($submajor as $submajor) {
            Submajor::create($submajor);
        }
    }
}
