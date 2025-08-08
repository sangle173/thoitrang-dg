<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Anh Nguyễn Văn Minh',
                'location' => 'TP. Hồ Chí Minh',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Tôi rất hài lòng với thiết kế biệt thự của LuxVilla. Không gian sống tuyệt vời và đội ngũ chuyên nghiệp.',
                'order' => 1,
            ],
            [
                'name' => 'Chị Trần Thị Hồng',
                'location' => 'Đà Nẵng',
                'avatar' => null,
                'rating' => 4,
                'content' => 'Thi công đúng tiến độ, thiết kế tinh tế và hợp phong thủy. Cảm ơn đội ngũ LuxVilla.',
                'order' => 2,
            ],
            [
                'name' => 'Anh Phạm Quốc Huy',
                'location' => 'Hà Nội',
                'avatar' => null,
                'rating' => 5,
                'content' => 'LuxVilla mang đến trải nghiệm chuyên nghiệp và tận tâm từ lúc tư vấn đến khi hoàn thành.',
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::create($item);
        }
    }
}

