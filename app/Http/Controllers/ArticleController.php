<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\User;
use App\Models\Admin;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // ユーザーお知らせページへ推移
    public function user_notice() {
        //テスト用
        $user = User::find(2);
        Auth::login($user);
        
        // ここから本コード
        $user = Auth::user();
        $article = Article::find(1);

        if($user === null){
            return view('userLogin');
        }else{
            return view('user_notice')->with([
                'article' => $article,
                'user' => $user,
            ]);
        }
    }

    // 管理お知らせ一覧ページへ推移
    public function notice() 
    {
        $admin = Admin::find(1);
        Auth::login($admin);

        $admin = Auth::user();
        $articles = Article::all();

        return view('admin_notice')->with([
            'articles' => $articles,
        ]);
    }

    // 管理お知らせ変更ページへ推移
    public function notice_update_show($id) 
    {
        $article = Article::find($id);

        return view('admin_notice_update')->with([
            'article' => $article,
        ]);
    }

    // 管理お知らせ登録ページへ推移
    public function article_regist_show() 
    {
        //
    }


    // 管理お知らせ変更
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

    // 管理お知らせ削除
    public function notice_delete($id)
    {
        DB::beginTransaction();
        try {
            $article = Article::find($id);

            $article->deleteBookById($article, $id);
            
        } catch (Exception $e) {
            return redirect()->route('admin_notice')->with('message', '削除に失敗しました');
            DB::rollBack();
        }

        DB::commit();
        return response()->json([$article]);
    }
}

