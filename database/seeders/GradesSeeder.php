<?php

namespace Database\Seeders;

use App\Models\Grade;
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
        for ($i = 0; $i < count($grade_names); $i++) {
            $id = $i + 1;
            if (!Grade::where('id', $id)->exists()) {
                $now = Carbon::now();
                DB::table('grades')->insert([
                    'id' => $i + 1,
                    'name' => $grade_names[$i],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
