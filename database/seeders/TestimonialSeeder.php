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
                'name' => 'Chị Nguyễn Thị Lan',
                'location' => 'TP. Hồ Chí Minh',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Tôi rất hài lòng với bộ váy dạ hội từ Dương Gia Fashion. Thiết kế tinh tế và vừa vặn hoàn hảo.',
                'order' => 1,
            ],
            [
                'name' => 'Chị Trần Thị Hương',
                'location' => 'Hà Nội',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Dịch vụ may đo rất chuyên nghiệp. Áo cưới của tôi đẹp hơn mong đợi, cảm ơn team Dương Gia!',
                'order' => 2,
            ],
            [
                'name' => 'Chị Lê Minh Phương',
                'location' => 'Đà Nẵng',
                'avatar' => null,
                'rating' => 5,
                'content' => 'Chất lượng vải tuyệt vời, đường may tinh tế. Dương Gia Fashion xứng đáng là thương hiệu thời trang hàng đầu.',
                'order' => 3,
            ],
            [
                'name' => 'Chị Vũ Thị Mai',
                'location' => 'Cần Thơ',
                'avatar' => null,
                'rating' => 4,
                'content' => 'Tư vấn phong cách rất tận tình. Giúp tôi tìm được phong cách phù hợp với công việc và cá tính.',
                'order' => 4,
            ],
        ];

        foreach ($testimonials as $item) {
            Testimonial::create($item);
        }
    }
}

