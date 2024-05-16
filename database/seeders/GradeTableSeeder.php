<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Http\Model\Grade;

class GradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create([
            'id' => '1',
            'name' => '小学校1年生',
        ]);
        Grade::create([
            'id' => '2',
            'name' => '小学校2年生',
        ]);
        Grade::create([
            'id' => '3',
            'name' => '小学校3年生',
        ]);
        Grade::create([
            'id' => '4',
            'name' => '小学校4年生',
        ]);
        Grade::create([
            'id' => '5',
            'name' => '小学校5年生',
        ]);
        Grade::create([
            'id' => '6',
            'name' => '小学校6年生',
        ]);
        Grade::create([
            'id' => '7',
            'name' => '中学校1年生',
        ]);
        Grade::create([
            'id' => '8',
            'name' => '中学校2年生',
        ]);
        Grade::create([
            'id' => '9',
            'name' => '中学校3年生',
        ]);
        Grade::create([
            'id' => '10',
            'name' => '高校1年生',
        ]);
        Grade::create([
            'id' => '11',
            'name' => '高校2年生',
        ]);
        Grade::create([
            'id' => '12',
            'name' => '高校3年生',
        ]);
    }
}
