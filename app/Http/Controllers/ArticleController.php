<?php

namespace App\Http\Controllers;
use App\Models\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function notice_show() {
        $article = Article::find(1);

        return view('notice')->with([
            'article' => $article,
        ]);
    }
}
