<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::truncate(); // optional reset

        $data = [
            [
                'name' => 'Nguyễn Dương Gia',
                'position' => 'Nhà thiết kế chính, Giám đốc sáng tạo',
                'photo' => 'uploads/team/duong-gia.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Trần Minh Châu',
                'position' => 'Nhà thiết kế thời trang cao cấp',
                'photo' => 'uploads/team/minh-chau.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Lê Thị Hương',
                'position' => 'Chuyên gia tư vấn phong cách',
                'photo' => 'uploads/team/thi-huong.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Phạm Văn Thành',
                'position' => 'Thợ may trưởng - Chuyên gia may đo',
                'photo' => 'uploads/team/van-thanh.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Võ Thị Lan',
                'position' => 'Nhà thiết kế váy cưới & dạ hội',
                'photo' => 'uploads/team/thi-lan.jpg',
                'order' => 5,
            ],
            [
                'name' => 'Nguyễn Hoài An',
                'position' => 'Quản lý chất lượng sản phẩm',
                'photo' => 'uploads/team/hoai-an.jpg',
                'order' => 6,
            ],
        ];

        foreach ($data as $member) {
            TeamMember::create($member);
        }
    }
}


