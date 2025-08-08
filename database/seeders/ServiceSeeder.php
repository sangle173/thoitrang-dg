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
                'title' => 'Thiết kế thời trang cá nhân',
                'service_category_id' => 1, // Thiết kế thời trang
                'description' => 'Tư vấn và thiết kế trang phục theo phong cách và sở thích cá nhân của khách hàng.',
                'short_description' => 'Thiết kế riêng biệt cho từng khách hàng',
                'icon' => 'bi bi-palette',
                'slug' => 'thiet-ke-thoi-trang-ca-nhan',
                'order' => 1,
            ],
            [
                'title' => 'May đo cao cấp',
                'service_category_id' => 2, // May đo cao cấp
                'description' => 'Dịch vụ may đo với kỹ thuật chính xác, đảm bảo vừa vặn hoàn hảo với từng vóc dáng.',
                'short_description' => 'May đo chính xác, vừa vặn hoàn hảo',
                'icon' => 'bi bi-scissors',
                'slug' => 'may-do-cao-cap',
                'order' => 2,
            ],
            [
                'title' => 'Tư vấn phong cách thời trang',
                'service_category_id' => 3, // Tư vấn phong cách
                'description' => 'Tư vấn phong cách phù hợp với tính cách, nghề nghiệp và dáng người của khách hàng.',
                'short_description' => 'Tìm phong cách phù hợp với bạn',
                'icon' => 'bi bi-person-check',
                'slug' => 'tu-van-phong-cach',
                'order' => 3,
            ],
            [
                'title' => 'Thiết kế váy cưới',
                'service_category_id' => 4, // Thời trang dạ hội
                'description' => 'Chuyên thiết kế và may váy cưới độc đáo, lãng mạn cho ngày trọng đại của bạn.',
                'short_description' => 'Váy cưới đẹp cho ngày trọng đại',
                'icon' => 'bi bi-heart',
                'slug' => 'thiet-ke-vay-cuoi',
                'order' => 4,
            ],
            [
                'title' => 'Thời trang dạ hội',
                'service_category_id' => 4, // Thời trang dạ hội
                'description' => 'Thiết kế váy dạ hội sang trọng cho các sự kiện quan trọng và tiệc tối.',
                'short_description' => 'Váy dạ hội quyến rũ, sang trọng',
                'icon' => 'bi bi-gem',
                'slug' => 'thoi-trang-da-hoi',
                'order' => 5,
            ],
            [
                'title' => 'Sửa chữa và chỉnh sửa',
                'service_category_id' => 2, // May đo cao cấp
                'description' => 'Dịch vụ sửa chữa, chỉnh sửa trang phục để phù hợp hơn với vóc dáng.',
                'short_description' => 'Sửa chữa, chỉnh sửa trang phục',
                'icon' => 'bi bi-tools',
                'slug' => 'sua-chua-chinh-sua',
                'order' => 6,
            ],
        ];

        foreach ($items as $item) {
            Service::create($item);
        }
    }
}
