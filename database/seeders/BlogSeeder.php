<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fashionPosts = [
            [
                'title' => 'Xu Hướng Thời Trang Xuân Hè 2025',
                'content' => '<p>Khám phá những xu hướng thời trang hot nhất mùa xuân hè 2025. Từ màu sắc tươi sáng đến những kiểu dáng hiện đại, <strong>Dương Gia Fashion</strong> mang đến cho bạn cái nhìn tổng quan về thế giới thời trang.</p><p>Những tông màu pastel nhẹ nhàng kết hợp với chất liệu linen thoáng mát sẽ là lựa chọn hoàn hảo cho mùa hè này.</p>',
            ],
            [
                'title' => 'Cách Phối Đồ Công Sở Thanh Lịch',
                'content' => '<p>Bí quyết phối đồ công sở vừa <strong>thanh lịch</strong> vừa <strong>hiện đại</strong>. Tìm hiểu cách kết hợp áo sơ mi, blazer và chân váy để tạo nên phong cách chuyên nghiệp.</p><p>Đặc biệt, những chiếc áo blazer cắt may tinh tế của Dương Gia sẽ giúp bạn tự tin trong mọi cuộc họp.</p>',
            ],
            [
                'title' => 'Bộ Sưu Tập Dạ Hội Sang Trọng',
                'content' => '<p>Giới thiệu bộ sưu tập váy dạ hội mới nhất với thiết kế <strong>sang trọng</strong> và <strong>tinh tế</strong>. Mỗi chiếc váy đều được chế tác tỉ mỉ với chất liệu cao cấp.</p><p>Từ những chiếc váy dài lộng lẫy đến váy cocktail ngắn quyến rũ, chúng tôi có đầy đủ lựa chọn cho mọi dịp đặc biệt.</p>',
            ],
            [
                'title' => 'Chất Liệu Vải Cao Cấp - Bí Quyết Tạo Nên Sản Phẩm Hoàn Hảo',
                'content' => '<p>Tìm hiểu về các loại <strong>chất liệu vải cao cấp</strong> mà Dương Gia Fashion sử dụng. Từ lụa tự nhiên đến cotton organic, mỗi loại vải đều được lựa chọn kỹ lưỡng.</p><p>Quy trình kiểm soát chất lượng nghiêm ngặt đảm bảo sản phẩm cuối cùng luôn đạt tiêu chuẩn cao nhất.</p>',
            ],
            [
                'title' => 'Thời Trang Bền Vững - Xu Hướng Tương Lai',
                'content' => '<p><strong>Thời trang bền vững</strong> không chỉ là xu hướng mà còn là trách nhiệm với môi trường. Dương Gia Fashion cam kết sử dụng nguyên liệu thân thiện với môi trường.</p><p>Chúng tôi tin rằng thời trang đẹp phải đi đôi với việc bảo vệ hành tinh xanh cho thế hệ tương lai.</p>',
            ],
        ];

        foreach ($fashionPosts as $post) {
            Blog::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'content' => $post['content'],
                'thumbnail' => null,
                'hashtags' => '#DuongGiaFashion #ThoiTrang #Fashion',
            ]);
        }
    }
}
