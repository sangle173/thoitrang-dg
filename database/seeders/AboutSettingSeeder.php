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
            'title' => 'Về Chúng Tôi',
            'short_description' => 'Chúng tôi là đơn vị chuyên thiết kế và thi công biệt thự đẳng cấp, mang đến không gian sống lý tưởng cho hàng nghìn khách hàng.',
            'full_description' => 'Với hơn 10 năm kinh nghiệm, đội ngũ kiến trúc sư và kỹ sư của chúng tôi luôn đặt chất lượng và sự sáng tạo lên hàng đầu. Chúng tôi cam kết mang đến giải pháp tối ưu cho từng công trình, từ bản vẽ cho đến khi bàn giao.',
            'button_text' => 'Xem thêm',
            'button_link' => '/gioi-thieu',
            'image' => 'uploads/about-default.jpg', // You can change or upload the image manually to public/storage/uploads/
        ]);
    }
}
