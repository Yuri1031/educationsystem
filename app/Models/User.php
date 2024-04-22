<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class User extends Model
{
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    // プロフィール変更
    public function updataProfile($request, $user, $file_name)
    {
        $user->name = $request->input('user_name');
        $user->profile_image = $file_name;
        $user->name_kana = $request->input('user_name_kana');
        $user->email = $request->input('email');

        $user->save();
    }


    // パスワード変更
    public function updataPassword($request, $user)
    {
        $user->password = $request->input('new_password');

        $user->save();
    }
}
