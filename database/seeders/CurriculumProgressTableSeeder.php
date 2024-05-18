<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CurriculumProgress;
use App\Models\User;

class CurriculumProgressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CurriculumProgress::create([
            'id' => '1',
            'curriculum_id' => '1',
            'user_id' => '1',
            'clear_flg' => '1',
        ]);
        CurriculumProgress::create([
            'id' => '2',
            'curriculum_id' => '1',
            'user_id' => '2',
            'clear_flg' => '1',
        ]);
        CurriculumProgress::create([
            'id' => '3',
            'curriculum_id' => '2',
            'user_id' => '2',
            'clear_flg' => '1',
        ]);
    }
}
