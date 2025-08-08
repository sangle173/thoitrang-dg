<?php

namespace Database\Seeders;

use App\Models\ContactSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactSetting::firstOrCreate([], [
            'headline' => 'Liên Hệ Với Dương Gia Fashion',
            'subheadline' => 'Hãy để chúng tôi tư vấn và tạo nên phong cách thời trang riêng cho bạn',
            'note' => 'Chúng tôi cam kết phản hồi trong vòng 24 giờ và luôn sẵn sàng tư vấn miễn phí về phong cách thời trang phù hợp với bạn.',
            'button_text' => 'Gửi Liên Hệ',
        ]);
    }
}
