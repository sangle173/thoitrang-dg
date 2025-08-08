<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Thiết kế kiến trúc', 'slug' => 'thiet-ke-kien-truc', 'short_description' => 'Tư vấn và thiết kế biệt thự chuyên nghiệp.'],
            ['name' => 'Thi công nội thất', 'slug' => 'thi-cong-noi-that', 'short_description' => 'Đội ngũ thi công giàu kinh nghiệm.'],
            ['name' => 'Giám sát công trình', 'slug' => 'giam-sat-cong-trinh', 'short_description' => 'Đảm bảo chất lượng và tiến độ công trình.'],
        ];

        foreach ($data as $item) {
            ServiceCategory::create($item);
        }
    }
}
