<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'id' => '1',
            'title' => '配信動画追加のお知らせ',
            'posted_date' => '2023-11-20',
            'article_contents' => '配信動画が新しく追加されました。'
        ]);
        Article::create([
            'id' => '2',
            'title' => 'パスワード変更のお願い',
            'posted_date' => '2020-01-01',
            'article_contents' => 'パスワード更新を行いましょう。'
        ]);
    }
}
