<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTopController extends Controller
{
    public function show()
    {
        // 現在ログインしている管理者の情報を取得
        $user = Auth::guard('admin')->user();
        
        // ユーザーネームとメールアドレスを取得
        $username = $user->name;
        $email = $user->email;
        
        // ビューにデータを渡して表示
        return view('admin.top', compact('username', 'email'));
    }
}
