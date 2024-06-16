<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CurriculumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dir = __DIR__ . '/img/test.png';

        for ($g = 1; $g <= 12; $g++) {
            $q = rand(1, 10);
            for ($i = 0; $i < $q; $i++) {
                $now = Carbon::now();
                $data = [
                    'title' => '授業' . $i,
                    'description' => '説明',
                    'video_url' => 'https://video.com/video/' . $i,
                    'thumbnail' => 'test.png',
                    'grade_id' => $g,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                $curriculum = Curriculum::create($data);

                $handle = fopen($dir, 'r');
                if ($handle) {
                    $contents = fread($handle, filesize($dir));
                    fclose($handle);
                    Storage::disk('public')->put('uploads/' . $curriculum->id . '/' . $curriculum->thumbnail, $contents);
                } else {
                    // エラーハンドリング
                    echo "Failed to open file.";
                    exit;
                }
            }
        }
    }
}
