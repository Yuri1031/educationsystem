<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curriculums = [
            [
                'title' => '国語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '国語の授業',
                'video_url' => 'https://example.com/video1.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '算数',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '算数の授業',
                'video_url' => 'https://example.com/video2.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '理科',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '理科の授業',
                'video_url' => 'https://example.com/video3.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '社会',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '社会の授業',
                'video_url' => 'https://example.com/video4.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '英語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '英語の授業',
                'video_url' => 'https://example.com/video5.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'フランス語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => 'フランス語の授業',
                'video_url' => 'https://example.com/video6.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ドイツ語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => 'ドイツ語の授業',
                'video_url' => 'https://example.com/video7.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ヌンジャイ語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => 'ヌンジャイ語の授業',
                'video_url' => 'https://example.com/video8.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ペキスタン語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => 'ペキスタンの授業',
                'video_url' => 'https://example.com/video9.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '上学',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '上学の授業',
                'video_url' => 'https://example.com/video10.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '下学',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => '下学の授業',
                'video_url' => 'https://example.com/video11.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ヤリラフィー語',
                'thumbnail' => '20240504095515_0_Sample2.jpg',
                'description' => 'ヤリラフィー語の授業',
                'video_url' => 'https://example.com/video12.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($curriculums as $curriculum) {
            DB::table('curriculums')->insert($curriculum);
        }
    }
}
