<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Http\Model\User;
use Http\Model\Grade;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'name' => '山田太郎',
            'name_kana' => 'ヤマダタロウ',
            'email' => 'hoge@example.com',
            'password' => 'hogehoge',
            'profile_image' => 'storage/sample/hoge.png',
            'grade_id' => '6',
        ]);
        User::create([
            'id' => '2',
            'name' => '鈴木花子',
            'name_kana' => 'スズキハナコ',
            'email' => 'sample@example.com',
            'password' => 'samplehanako',
            'profile_image' => 'storage/sample/sample.png',
            'grade_id' => '10',
        ]);
    }
}
