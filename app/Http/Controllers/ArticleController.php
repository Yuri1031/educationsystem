<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // お知らせ一覧ページへ推移
    public function notice() 
    {
        $articles = Article::all();

        return view('notice')->with([
            'articles' => $articles,
        ]);
    }

    // お知らせ変更ページへ推移
    public function notice_update_show($id) 
    {
        $article = Article::find($id);

        return view('notice_update')->with([
            'article' => $article,
        ]);
    }

    // お知らせ登録ページへ推移
    public function article_regist_show() 
    {
        //
    }


    // お知らせ変更
    public function notice_update(ArticleUpdateRequest $request, $id) 
    {
        DB::beginTransaction();

        try {
            $article = Article::find($id);

            $article->updataArticle($request, $article);

            
        } catch (Exception $e) {
            return redirect()->route('notice')->with('message', '登録に失敗しました');
            DB::rollBack();
        }

        DB::commit();
        return redirect()->route('notice')->with('message', 'お知らせ内容を更新しました。');
    }

    // お知らせ削除
    public function notice_delete($id)
    {
        DB::beginTransaction();
        try {
            $article = Article::find($id);

            $article->deleteBookById($article, $id);
            
        } catch (Exception $e) {
            return redirect()->route('notice')->with('message', '削除に失敗しました');
            DB::rollBack();
        }

        DB::commit();
        return response()->json([$article]);
    }
}

