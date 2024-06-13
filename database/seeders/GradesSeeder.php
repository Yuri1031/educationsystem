<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grade_names = [
            '小学校1年生',
            '小学校2年生',
            '小学校3年生',
            '小学校4年生',
            '小学校5年生',
            '小学校6年生',
            '中学校1年生',
            '中学校2年生',
            '中学校3年生',
            '高校1年生',
            '高校2年生',
            '高校3年生',
        ];
        foreach ($grade_names as $name) {
            $now = Carbon::now();
            DB::table('grades')->insert([
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
