<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PortfolioCategory;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Thời trang công sở', 'slug' => 'thoi-trang-cong-so', 'short_description' => 'Trang phục lịch sự cho môi trường công sở.'],
            ['name' => 'Váy dạ hội', 'slug' => 'vay-da-hoi', 'short_description' => 'Những thiết kế váy dạ hội sang trọng, quyến rũ.'],
            ['name' => 'Thời trang casual', 'slug' => 'thoi-trang-casual', 'short_description' => 'Phong cách thoải mái cho cuộc sống hàng ngày.'],
            ['name' => 'Áo cưới', 'slug' => 'ao-cuoi', 'short_description' => 'Những thiết kế áo cưới độc đáo, lãng mạn.'],
        ];

        foreach ($data as $item) {
            PortfolioCategory::create($item);
        }
    }
}

