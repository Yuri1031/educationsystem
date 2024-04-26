<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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
