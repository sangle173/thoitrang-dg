<?php

namespace Database\Seeders;

use App\Models\Strength;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StrengthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            [
                'title' => 'Kinh nghiệm 10+ năm',
                'description' => 'Chúng tôi có hơn một thập kỷ trong lĩnh vực thiết kế và xây dựng biệt thự.',
                'icon' => 'bi bi-award',
                'order' => 1,
            ],
            [
                'title' => 'Kiến trúc sư chuyên nghiệp',
                'description' => 'Đội ngũ sáng tạo, giàu kinh nghiệm và luôn đặt khách hàng lên hàng đầu.',
                'icon' => 'bi bi-people',
                'order' => 2,
            ],
            [
                'title' => 'Thiết kế theo yêu cầu',
                'description' => 'Mỗi thiết kế được cá nhân hóa để phù hợp với phong cách sống và mong muốn của bạn.',
                'icon' => 'bi bi-brush',
                'order' => 3,
            ],
            [
                'title' => 'Bảo hành & hỗ trợ dài hạn',
                'description' => 'Dịch vụ hậu mãi tận tâm giúp bạn an tâm trong suốt quá trình sử dụng.',
                'icon' => 'bi bi-shield-check',
                'order' => 4,
            ],
        ];

        foreach ($items as $item) {
            Strength::create($item);
        }
    }
}
