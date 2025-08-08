<?php

namespace Database\Seeders;

use App\Models\HeroSlider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSlider::create([
            'image' => 'uploads/hero1.jpg',
            'headline' => 'Thiết Kế Biệt Thự Đẳng Cấp',
            'subheadline' => 'Mang đến không gian sống lý tưởng cho gia đình bạn',
            'button_text' => 'Xem Dự Án',
            'button_link' => '/projects',
            'order' => 1,
        ]);

        HeroSlider::create([
            'image' => 'uploads/hero2.jpg',
            'headline' => 'Không Gian Sống Tinh Tế',
            'subheadline' => 'Được thiết kế theo phong cách hiện đại và đẳng cấp',
            'button_text' => 'Liên hệ tư vấn',
            'button_link' => '/contact',
            'order' => 2,
        ]);
    }
}
