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
                'title' => 'Kinh nghiệm 5+ năm thời trang',
                'description' => 'Chúng tôi có hơn 5 năm kinh nghiệm trong lĩnh vực thiết kế và sản xuất thời trang cao cấp.',
                'icon' => 'bi bi-award',
                'order' => 1,
            ],
            [
                'title' => 'Thợ may chuyên nghiệp',
                'description' => 'Đội ngũ thợ may giàu kinh nghiệm, kỹ thuật tinh tế và luôn đặt chất lượng lên hàng đầu.',
                'icon' => 'bi bi-people',
                'order' => 2,
            ],
            [
                'title' => 'Thiết kế theo yêu cầu',
                'description' => 'Mỗi trang phục được thiết kế riêng để phù hợp với phong cách và vóc dáng của bạn.',
                'icon' => 'bi bi-brush',
                'order' => 3,
            ],
            [
                'title' => 'Chất liệu cao cấp',
                'description' => 'Sử dụng 100% chất liệu nhập khẩu cao cấp, đảm bảo độ bền và thoải mái khi mặc.',
                'icon' => 'bi bi-gem',
                'order' => 4,
            ],
            [
                'title' => 'Giao hàng tận nơi',
                'description' => 'Dịch vụ giao hàng miễn phí tại TP.HCM và hỗ trợ vận chuyển toàn quốc.',
                'icon' => 'bi bi-truck',
                'order' => 5,
            ],
            [
                'title' => 'Bảo hành sản phẩm',
                'description' => 'Cam kết bảo hành và sửa chữa miễn phí trong 6 tháng đầu sau khi mua.',
                'icon' => 'bi bi-shield-check',
                'order' => 6,
            ],
        ];

        foreach ($items as $item) {
            Strength::create($item);
        }
    }
}
