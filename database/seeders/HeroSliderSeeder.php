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
            'image' => 'uploads/hero-fashion-1.jpg',
            'headline' => 'Dương Gia Fashion - Thời Trang Đẳng Cấp',
            'subheadline' => 'Khám phá bộ sưu tập thời trang cao cấp với thiết kế độc đáo và chất lượng hoàn hảo',
            'button_text' => 'Xem Bộ Sưu Tập',
            'button_link' => '/du-an',
            'order' => 1,
        ]);

        HeroSlider::create([
            'image' => 'uploads/hero-fashion-2.jpg',
            'headline' => 'May Đo Cao Cấp - Vừa Vặn Hoàn Hảo',
            'subheadline' => 'Dịch vụ may đo chuyên nghiệp với đội ngũ thợ may giàu kinh nghiệm',
            'button_text' => 'Đặt Lịch Tư Vấn',
            'button_link' => '/lien-he',
            'order' => 2,
        ]);

        HeroSlider::create([
            'image' => 'uploads/hero-fashion-3.jpg',
            'headline' => 'Váy Dạ Hội Sang Trọng',
            'subheadline' => 'Những thiết kế váy dạ hội quyến rũ cho các sự kiện đặc biệt',
            'button_text' => 'Khám Phá Ngay',
            'button_link' => '/dich-vu/thoi-trang-da-hoi',
            'order' => 3,
        ]);
    }
}
