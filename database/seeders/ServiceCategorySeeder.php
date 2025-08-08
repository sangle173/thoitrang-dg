<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Thiết kế thời trang', 'slug' => 'thiet-ke-thoi-trang', 'short_description' => 'Thiết kế trang phục theo yêu cầu riêng.'],
            ['name' => 'May đo cao cấp', 'slug' => 'may-do-cao-cap', 'short_description' => 'Dịch vụ may đo chuyên nghiệp, vừa vặn hoàn hảo.'],
            ['name' => 'Tư vấn phong cách', 'slug' => 'tu-van-phong-cach', 'short_description' => 'Tư vấn phong cách thời trang phù hợp với từng khách hàng.'],
            ['name' => 'Thời trang dạ hội', 'slug' => 'thoi-trang-da-hoi', 'short_description' => 'Chuyên thiết kế váy dạ hội, trang phục sự kiện.'],
        ];

        foreach ($data as $item) {
            ServiceCategory::create($item);
        }
    }
}
