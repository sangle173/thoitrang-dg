<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $items = [
            [
                'title' => 'Thiết kế kiến trúc biệt thự',
                'description' => 'Giải pháp thiết kế hiện đại, phù hợp với không gian và nhu cầu.',
                'icon' => 'bi bi-house-door',
                'order' => 1,
            ],
            [
                'title' => 'Thi công nội thất',
                'description' => 'Đảm bảo chất lượng thi công, vật liệu và tiến độ.',
                'icon' => 'bi bi-hammer',
                'order' => 2,
            ],
            [
                'title' => 'Giám sát công trình',
                'description' => 'Đội ngũ chuyên môn cao, đảm bảo đúng thiết kế và tiêu chuẩn.',
                'icon' => 'bi bi-binoculars',
                'order' => 3,
            ],
            [
                'title' => 'Tư vấn phong thủy',
                'description' => 'Đưa ra giải pháp phong thủy hài hòa và phù hợp với gia chủ.',
                'icon' => 'bi bi-compass',
                'order' => 4,
            ],
        ];

        foreach ($items as $item) {
            Service::create($item);
        }
    }
}
