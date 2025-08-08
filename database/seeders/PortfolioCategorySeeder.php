<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioCategory;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Biệt thự hiện đại', 'slug' => 'biet-thu-hien-dai', 'short_description' => 'Phong cách thiết kế hiện đại, tối giản.'],
            ['name' => 'Biệt thự cổ điển', 'slug' => 'biet-thu-co-dien', 'short_description' => 'Mang đậm nét cổ kính và sang trọng.'],
            ['name' => 'Biệt thự nghỉ dưỡng', 'slug' => 'biet-thu-nghi-duong', 'short_description' => 'Thiết kế tối ưu cho không gian nghỉ dưỡng.'],
        ];

        foreach ($data as $item) {
            PortfolioCategory::create($item);
        }
    }
}

