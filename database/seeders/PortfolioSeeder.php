<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portfolio::insert([
            [
                'title' => 'Biệt thự hiện đại Quận 7',
                'location' => 'TP. Hồ Chí Minh',
                'description' => 'Biệt thự 3 tầng phong cách hiện đại với không gian mở, sử dụng vật liệu cao cấp và thiết kế tối ưu ánh sáng tự nhiên.',
                'image' => 'uploads/portfolio1.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Villa nghỉ dưỡng Đà Lạt',
                'location' => 'Đà Lạt',
                'description' => 'Không gian nghỉ dưỡng hòa mình với thiên nhiên, thiết kế mái dốc và nội thất ấm cúng, lý tưởng cho gia đình.',
                'image' => 'uploads/portfolio2.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Biệt thự ven sông Cần Thơ',
                'location' => 'Cần Thơ',
                'description' => 'Biệt thự rộng rãi nằm ven sông với sân vườn lớn, hồ bơi riêng và phong cách kiến trúc Đông Dương.',
                'image' => 'uploads/portfolio3.jpg',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
