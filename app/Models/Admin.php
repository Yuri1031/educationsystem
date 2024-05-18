<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Admin extends Model implements Authenticatable
{
    use HasFactory;



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
