<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    // 新規登録
    public function registArticle($request)
    {
        DB::table('articles')->insert([
            'posted_date' => $request->input('posted_date'),
            'title' => $request->input('title'),
            'article_contents' => $request->input('article_contents'),
        ]);
    }

    // お知らせ変更
    public function updataArticle($request, $article) 
    {
        $article->posted_date = $request->input('posted_date');
        $article->title = $request->input('title');
        $article->article_contents = $request->input('article_contents');

        $article->save();
    }

    //お知らせ削除
    public function deleteBookById($article, $id) 
    {
        $article->destroy($id);

    }
}
