<?php

namespace Database\Seeders;

use App\Models\HeaderSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeaderSetting::create([
            'logo' => 'uploads/logo.png',
            'email' => 'contact@villadesign.vn',
            'phone' => '0909 999 999',
        ]);
    }
}
