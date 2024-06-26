<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class User extends Model implements Authenticatable
{
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    // プロフィール変更
    public function updataProfile($request, $user, $file_name)
    {
        if ($request->input('user_name') !== null) {
            $user->name = $request->input('user_name');
        }
        
        if ($request->input('user_name_kana') !== null) {
            $user->name_kana = $request->input('user_name_kana');
        }
        
        if ($request->input('email') !== null) {
            $user->email = $request->input('email');
        }

        $user->profile_image = $file_name;
        
        $user->save();
    }


    // パスワード変更
    public function updataPassword($request, $user)
    {
        $user->password = $request->input('new_password');

        $user->save();
    }
    

    protected $primaryKey = 'id'; // データベースのプライマリキー

    // ユーザーの識別子名を取得するメソッド
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    // ユーザーの識別子を取得するメソッド
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    // ユーザーのパスワードを取得するメソッド
    public function getAuthPassword()
    {
        return $this->password;
    }

    // ユーザーの「Remember me」トークンを取得するメソッド
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    // ユーザーの「Remember me」トークンを設定するメソッド
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    // ユーザーの「Remember me」トークン名を取得するメソッド
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

}
