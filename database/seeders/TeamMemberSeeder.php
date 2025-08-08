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
                'name' => 'Phạm Lợi',
                'position' => 'Kiến trúc sư, Chủ trì kiến trúc',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5103823627424_13f2582aab486f5942bb52259685fc14-374x224.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Phạm Hòa',
                'position' => 'Kiến trúc sư, Quản lý thi công',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5103854674818_d78cb600292144264ef1b11b48e3f7bd-374x224.jpg',
                'order' => 2,
            ],
            [
                'name' => 'Lê Huế',
                'position' => 'Kiến trúc sư',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5103824328896_ee1c9065858a5bc1ae145a17d21a4f6c-374x224.jpg',
                'order' => 3,
            ],
            [
                'name' => 'Trần Phong',
                'position' => 'Kiến trúc sư nội thất',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5105784740188_c96c3893c8418942be2811120468f4ad-374x224.jpg',
                'order' => 4,
            ],
            [
                'name' => 'Trương Phương',
                'position' => 'Kỹ sư ME',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5110755949018_3140464132379fcac70ee11b83a34337-374x224.jpg',
                'order' => 5,
            ],
            [
                'name' => 'Lê Tâm',
                'position' => 'Kỹ sư kết cấu',
                'photo' => 'https://ivyarchi.vn/wp-content/uploads/2024/01/z5112776645256_4950158eb271275a8977ee4ec83eb286-374x224.jpg',
                'order' => 6,
            ],
        ];

        foreach ($data as $member) {
            TeamMember::create($member);
        }
    }
}


