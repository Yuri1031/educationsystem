<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            '小学１年生',
            '小学２年生',
            '小学３年生',
            '小学４年生',
            '小学５年生',
            '小学６年生',
            '中学１年生',
            '中学２年生',
            '中学３年生',
            '高校１年生',
            '高校２年生',
            '高校３年生',
        ];

        foreach ($grades as $key => $grade) {
            DB::table('grades')->insert([
                'id' => $key + 1, // 手動で id を割り当てる
                'name' => $grade,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
