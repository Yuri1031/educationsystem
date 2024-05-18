<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Http\Model\Grade;
use Http\Model\Curriculum;

class CurriculumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curriculum::create([
            'id' => '1',
            'title' => '掛け算について',
            'grade_id' => '3'
        ]);
        Curriculum::create([
            'id' => '2',
            'title' => '理科の実験',
            'grade_id' => '5'
        ]);
        Curriculum::create([
            'id' => '3',
            'title' => '大学受験に向けた学習',
            'grade_id' => '12'
        ]);
    }
}
