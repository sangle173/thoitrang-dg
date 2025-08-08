<?php

namespace Database\Seeders;

use App\Models\AboutSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSetting::firstOrCreate([], [
            'title' => 'Về Dương Gia Fashion',
            'short_description' => 'Dương Gia Fashion là thương hiệu thời trang cao cấp, chuyên thiết kế và sản xuất trang phục đẳng cấp cho phái đẹp hiện đại.',
            'full_description' => 'Với hơn 5 năm kinh nghiệm trong ngành thời trang, Dương Gia Fashion luôn tiên phong trong việc tạo ra những bộ sưu tập thời trang độc đáo, kết hợp giữa phong cách truyền thống và xu hướng hiện đại. Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chất lượng cao với giá cả hợp lý.',
            'button_text' => 'Tìm hiểu thêm',
            'button_link' => '/gioi-thieu',
            'image' => 'uploads/about-fashion.jpg',
        ]);
    }
}
