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
        // データを配列で準備
        $curriculums = [
            [
                'title' => 'サンプル授業1',
                'thumbnail' => 'thumbnail1.jpg',
                'description' => 'これはサンプル授業1の説明です。',
                'video_url' => 'https://example.com/video1.mp4',
                'alway_delivery_flg' => 1,
                'grade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'サンプル授業2',
                'thumbnail' => 'thumbnail2.jpg',
                'description' => 'これはサンプル授業2の説明です。',
                'video_url' => 'https://example.com/video2.mp4',
                'alway_delivery_flg' => 0,
                'grade_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 他のデータも同様に追加
        ];

        // データを挿入
        foreach ($curriculums as $curriculum) {
            DB::table('curriculums')->insert($curriculum);
        }
    }
}
