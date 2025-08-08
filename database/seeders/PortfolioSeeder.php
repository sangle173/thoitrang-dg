<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category IDs
        $categories = PortfolioCategory::all()->keyBy('name');
        
        $portfolios = [
            // Thời trang công sở (4 portfolios)
            [
                'title' => 'Bộ vest nữ cao cấp',
                'short_description' => 'Thiết kế vest nữ công sở hiện đại, thanh lịch với chất liệu cao cấp.',
                'description' => '<p>Bộ vest nữ công sở được thiết kế với đường may tinh tế, form dáng ôm vừa phải tôn lên vóc dáng người mặc. Sử dụng chất liệu vải cao cấp từ Hàn Quốc, bền đẹp và thoáng mát.</p><p>Đặc điểm nổi bật:</p><ul><li>Chất liệu vải cao cấp, không nhăn</li><li>Thiết kế hiện đại, thanh lịch</li><li>Phù hợp với môi trường công sở chuyên nghiệp</li><li>Có nhiều size từ S đến XL</li></ul>',
                'portfolio_category_id' => $categories['Thời trang công sở']->id,
                'location' => 'TP. Hồ Chí Minh',
                'image' => 'uploads/vest-nu-cong-so.jpg',
                'is_featured' => true,
                'order' => 1,
                'slug' => 'bo-vest-nu-cao-cap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Áo sơ mi công sở nữ',
                'short_description' => 'Áo sơ mi công sở với thiết kế trang nhã, phù hợp mọi dáng người.',
                'description' => '<p>Áo sơ mi công sở nữ với thiết kế đơn giản nhưng tinh tế, dễ dàng mix & match với nhiều trang phục khác nhau. Chất liệu cotton cao cấp, thoáng mát và thấm hút mồ hôi tốt.</p><p>Thông số kỹ thuật:</p><ul><li>Chất liệu: 100% cotton</li><li>Màu sắc: Trắng, xanh nhạt, hồng pastel</li><li>Thiết kế cổ vest thanh lịch</li><li>Dễ dàng bảo quản và giặt là</li></ul>',
                'portfolio_category_id' => $categories['Thời trang công sở']->id,
                'location' => 'Hà Nội',
                'image' => 'uploads/ao-so-mi-cong-so.jpg',
                'is_featured' => true,
                'order' => 2,
                'slug' => 'ao-so-mi-cong-so-nu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chân váy công sở A-line',
                'short_description' => 'Chân váy A-line thanh lịch, tôn dáng và phù hợp mọi vóc dáng.',
                'description' => '<p>Chân váy công sở dáng A-line với thiết kế cơ bản nhưng vô cùng thanh lịch và dễ mặc. Form dáng ôm vừa phải ở eo và xòe nhẹ về phía dưới, tôn lên đường cong cơ thể.</p><p>Đặc điểm:</p><ul><li>Dáng A-line cổ điển, tôn dáng</li><li>Chiều dài vừa phải, phù hợp môi trường công sở</li><li>Chất liệu co giãn nhẹ, thoải mái khi di chuyển</li><li>Dễ phối với áo sơ mi, áo blouse</li></ul>',
                'portfolio_category_id' => $categories['Thời trang công sở']->id,
                'location' => 'Đà Nẵng',
                'image' => 'uploads/chan-vay-cong-so.jpg',
                'is_featured' => false,
                'order' => 3,
                'slug' => 'chan-vay-cong-so-a-line',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Blazer nữ hiện đại',
                'short_description' => 'Áo blazer nữ thiết kế hiện đại, dễ phối đồ cho phong cách công sở.',
                'description' => '<p>Áo blazer nữ với thiết kế hiện đại, không cầu kỳ nhưng vẫn toát lên sự chuyên nghiệp và thanh lịch. Có thể mặc đi làm hoặc trong các buổi gặp gỡ quan trọng.</p><p>Ưu điểm:</p><ul><li>Thiết kế hiện đại, trẻ trung</li><li>Chất liệu cao cấp, form dáng chuẩn</li><li>Có thể mix với quần âu, chân váy</li><li>Màu sắc trung tính, dễ phối đồ</li></ul>',
                'portfolio_category_id' => $categories['Thời trang công sở']->id,
                'location' => 'Cần Thơ',
                'image' => 'uploads/blazer-nu-hien-dai.jpg',
                'is_featured' => false,
                'order' => 4,
                'slug' => 'blazer-nu-hien-dai',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Váy dạ hội (4 portfolios)
            [
                'title' => 'Váy dạ hội lộng lẫy',
                'short_description' => 'Thiết kế váy dạ hội sang trọng với chất liệu ren cao cấp và đính kết tinh tế.',
                'description' => '<p>Váy dạ hội được thiết kế với sự tỉ mỉ trong từng chi tiết, từ phần thân váy đến tay áo. Chất liệu ren cao cấp kết hợp với lớp lót silk mang đến cảm giác mềm mại và thoải mái.</p><p>Thông tin chi tiết:</p><ul><li>Chất liệu: Ren Pháp cao cấp + lót silk</li><li>Thiết kế: Cổ tim, tay dài ren</li><li>Màu sắc: Đỏ burgundy, đen, navy</li><li>Phù hợp: Tiệc cưới, dạ tiệc, sự kiện quan trọng</li></ul>',
                'portfolio_category_id' => $categories['Váy dạ hội']->id,
                'location' => 'TP. Hồ Chí Minh',
                'image' => 'uploads/vay-da-hoi-long-lay.jpg',
                'is_featured' => true,
                'order' => 5,
                'slug' => 'vay-da-hoi-long-lay',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Đầm dạ hội cổ điển',
                'short_description' => 'Đầm dạ hội phong cách cổ điển Âu với đường cắt may tinh tế.',
                'description' => '<p>Đầm dạ hội lấy cảm hứng từ phong cách cổ điển châu Âu, với đường cắt may tôn dáng và chất liệu cao cấp. Thiết kế vượt thời gian, phù hợp với mọi độ tuổi.</p><p>Đặc trưng:</p><ul><li>Thiết kế cổ điển, thanh lịch</li><li>Chất liệu taffeta cao cấp</li><li>Đường may tinh tế, tôn dáng</li><li>Phù hợp với các sự kiện trang trọng</li></ul>',
                'portfolio_category_id' => $categories['Váy dạ hội']->id,
                'location' => 'Hà Nội',
                'image' => 'uploads/dam-da-hoi-co-dien.jpg',
                'is_featured' => true,
                'order' => 6,
                'slug' => 'dam-da-hoi-co-dien',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Váy cocktail sequin',
                'short_description' => 'Váy cocktail ngắn với sequin lấp lánh, phù hợp cho các bữa tiệc tối.',
                'description' => '<p>Váy cocktail với thiết kế trẻ trung, hiện đại. Sequin được đính thủ công tỉ mỉ tạo hiệu ứng lấp lánh dưới ánh đèn. Chiều dài ngắn trên gối, tôn lên đôi chân dài.</p><p>Chi tiết sản phẩm:</p><ul><li>Chất liệu: Vải sequin cao cấp</li><li>Thiết kế: Cổ thuyền, tay ngắn</li><li>Chiều dài: Trên gối</li><li>Phù hợp: Cocktail party, tiệc tối</li></ul>',
                'portfolio_category_id' => $categories['Váy dạ hội']->id,
                'location' => 'Đà Nẵng',
                'image' => 'uploads/vay-cocktail-sequin.jpg',
                'is_featured' => false,
                'order' => 7,
                'slug' => 'vay-cocktail-sequin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Đầm maxi dạ hội',
                'short_description' => 'Đầm maxi dạ hội dáng dài, thanh lịch với chất liệu chiffon mềm mại.',
                'description' => '<p>Đầm maxi dạ hội với thiết kế dáng dài thanh lịch, chất liệu chiffon mềm mại tạo cảm giác nhẹ nhàng và bay bổng. Thiết kế phù hợp với các sự kiện trang trọng.</p><p>Thông số:</p><ul><li>Chất liệu: Chiffon cao cấp</li><li>Dáng: Maxi dài, xòe nhẹ</li><li>Cổ áo: Cổ V sâu thanh lịch</li><li>Màu sắc: Pastel, nude tone</li></ul>',
                'portfolio_category_id' => $categories['Váy dạ hội']->id,
                'location' => 'Hải Phòng',
                'image' => 'uploads/dam-maxi-da-hoi.jpg',
                'is_featured' => false,
                'order' => 8,
                'slug' => 'dam-maxi-da-hoi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Thời trang casual (4 portfolios)
            [
                'title' => 'Set đồ casual chic',
                'short_description' => 'Bộ đồ casual phối màu hiện đại, thoải mái cho cuối tuần.',
                'description' => '<p>Set đồ casual được thiết kế với phong cách chic hiện đại, kết hợp giữa sự thoải mái và thời trang. Phù hợp cho các hoạt động cuối tuần, dạo phố hoặc gặp gỡ bạn bè.</p><p>Bao gồm:</p><ul><li>Áo thun basic cao cấp</li><li>Quần jeans skinny</li><li>Áo khoác cardigan mỏng</li><li>Phụ kiện túi xách nhỏ</li></ul>',
                'portfolio_category_id' => $categories['Thời trang casual']->id,
                'location' => 'TP. Hồ Chí Minh',
                'image' => 'uploads/set-casual-chic.jpg',
                'is_featured' => true,
                'order' => 9,
                'slug' => 'set-do-casual-chic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Đầm suông basic',
                'short_description' => 'Đầm suông đơn giản, dễ mặc và phù hợp với mọi dáng người.',
                'description' => '<p>Đầm suông với thiết kế đơn giản nhưng tinh tế, dễ mặc và thoải mái cho các hoạt động hàng ngày. Chất liệu cotton mềm mại, thấm hút mồ hôi tốt.</p><p>Đặc điểm:</p><ul><li>Thiết kế suông, không bó sát</li><li>Chất liệu cotton 100%</li><li>Dễ phối với sandal, sneaker</li><li>Phù hợp đi chơi, đi làm casual</li></ul>',
                'portfolio_category_id' => $categories['Thời trang casual']->id,
                'location' => 'Hà Nội',
                'image' => 'uploads/dam-suong-basic.jpg',
                'is_featured' => true,
                'order' => 10,
                'slug' => 'dam-suong-basic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jumpsuit denim',
                'short_description' => 'Jumpsuit denim thời trang, cá tính và năng động.',
                'description' => '<p>Jumpsuit denim với thiết kế cá tính, năng động phù hợp với phong cách casual hiện đại. Dễ mặc, dễ phối đồ và tạo nên những outfit ấn tượng.</p><p>Thông tin:</p><ul><li>Chất liệu: Denim cotton cao cấp</li><li>Thiết kế: Cổ V, tay ngắn</li><li>Có belt đi kèm tôn eo</li><li>Màu sắc: Xanh denim cổ điển</li></ul>',
                'portfolio_category_id' => $categories['Thời trang casual']->id,
                'location' => 'Đà Nẵng',
                'image' => 'uploads/jumpsuit-denim.jpg',
                'is_featured' => false,
                'order' => 11,
                'slug' => 'jumpsuit-denim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Quần shorts kaki',
                'short_description' => 'Quần shorts kaki basic, thoải mái cho mùa hè.',
                'description' => '<p>Quần shorts kaki với thiết kế basic, thoải mái và dễ phối đồ. Chất liệu kaki cao cấp, bền đẹp và không bai màu sau nhiều lần giặt.</p><p>Ưu điểm:</p><ul><li>Chất liệu kaki cao cấp</li><li>Thiết kế basic, dễ phối</li><li>Có nhiều màu sắc: be, xanh navy, đen</li><li>Phù hợp với áo thun, áo sơ mi</li></ul>',
                'portfolio_category_id' => $categories['Thời trang casual']->id,
                'location' => 'Vũng Tàu',
                'image' => 'uploads/quan-shorts-kaki.jpg',
                'is_featured' => false,
                'order' => 12,
                'slug' => 'quan-shorts-kaki',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Áo cưới (4 portfolios)
            [
                'title' => 'Áo dài cưới truyền thống',
                'short_description' => 'Áo dài cưới truyền thống Việt Nam với họa tiết thêu tay tinh xảo.',
                'description' => '<p>Áo dài cưới truyền thống được thiết kế theo phong cách cổ điển Việt Nam, với họa tiết thêu tay tinh xảo và chất liệu lụa cao cấp. Mang đến vẻ đẹp dịu dàng, thanh lịch cho cô dâu.</p><p>Chi tiết sản phẩm:</p><ul><li>Chất liệu: Lụa tằm cao cấp</li><li>Họa tiết: Thêu tay hoa sen, phượng hoàng</li><li>Màu sắc: Đỏ, hồng, vàng gold</li><li>Phụ kiện: Khăn đóng, giày thêu đi kèm</li></ul>',
                'portfolio_category_id' => $categories['Áo cưới']->id,
                'location' => 'TP. Hồ Chí Minh',
                'image' => 'uploads/ao-dai-cuoi-truyen-thong.jpg',
                'is_featured' => true,
                'order' => 13,
                'slug' => 'ao-dai-cuoi-truyen-thong',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Váy cưới princess',
                'short_description' => 'Váy cưới dáng princess lộng lẫy với chất liệu ren và pha lê.',
                'description' => '<p>Váy cưới dáng princess với thiết kế lộng lẫy như trong truyện cổ tích. Phần thân váy được đính ren và pha lê thủ công, tạo hiệu ứng lấp lánh dưới ánh sáng.</p><p>Đặc điểm nổi bật:</p><ul><li>Dáng princess cổ điển</li><li>Chất liệu: Ren Pháp + tulle cao cấp</li><li>Đính pha lê Swarovski thủ công</li><li>Train dài 2-3m tùy chọn</li></ul>',
                'portfolio_category_id' => $categories['Áo cưới']->id,
                'location' => 'Hà Nội',
                'image' => 'uploads/vay-cuoi-princess.jpg',
                'is_featured' => true,
                'order' => 14,
                'slug' => 'vay-cuoi-princess',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Váy cưới mermaid',
                'short_description' => 'Váy cưới dáng mermaid ôm sát tôn dáng, phù hợp cô dâu có vóc dáng chuẩn.',
                'description' => '<p>Váy cưới dáng mermaid với thiết kế ôm sát từ thân trên đến đùi, sau đó xòe rộng tạo hiệu ứng đuôi cá. Tôn lên đường cong cơ thể một cách hoàn hảo.</p><p>Thông số:</p><ul><li>Dáng: Mermaid/Fishtail</li><li>Chất liệu: Satin + ren</li><li>Cổ áo: Cổ tim hoặc cổ thuyền</li><li>Phù hợp: Cô dâu có vóc dáng chuẩn</li></ul>',
                'portfolio_category_id' => $categories['Áo cưới']->id,
                'location' => 'Đà Nẵng',
                'image' => 'uploads/vay-cuoi-mermaid.jpg',
                'is_featured' => false,
                'order' => 15,
                'slug' => 'vay-cuoi-mermaid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Váy cưới bohemian',
                'short_description' => 'Váy cưới phong cách bohemian tự do, phù hợp cưới ngoài trời.',
                'description' => '<p>Váy cưới phong cách bohemian với thiết kế tự do, thoải mái. Chất liệu nhẹ nhàng, thoáng mát phù hợp cho các buổi cưới ngoài trời, bãi biển hoặc vườn.</p><p>Đặc trưng:</p><ul><li>Phong cách: Bohemian tự do</li><li>Chất liệu: Chiffon, georgette</li><li>Thiết kế: Tay dài ren, váy dài</li><li>Phù hợp: Cưới ngoài trời, bãi biển</li></ul>',
                'portfolio_category_id' => $categories['Áo cưới']->id,
                'location' => 'Phú Quốc',
                'image' => 'uploads/vay-cuoi-bohemian.jpg',
                'is_featured' => false,
                'order' => 16,
                'slug' => 'vay-cuoi-bohemian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}
