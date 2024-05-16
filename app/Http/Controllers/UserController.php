<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ログインページへ推移
    public function user_login(){
        //
    } 

    // ユーザーページへ推移
    public function user_show() {
        //
    }

    // プロフィール設定ページへ推移
    public function profile_update_show() {
        //テスト用
        $user = User::find(2);
        Auth::login($user);

        // ここから本コード
        $user = Auth::user();

        if($user === null){
            return view('userLogin');
        }else {
            return view('user_profile_update')->with([
                'user' => $user,
            ]);
        }
    }

    // プロフィール設定（変更）
    public function profile_update(ProfileUpdateRequest $request) {
        //テスト用
        $user = User::find(2);
        Auth::login($user);

        // ここから本コード
        $user = Auth::user();

        if($user === null){
            return view('userLogin');
        }else {
            $file = $request->file('profile_image');

            DB::beginTransaction();
            try {
                if($file !== null){
                    $file_name = 'storage/sample/' . $request->file('profile_image')->getClientOriginalName();

                    $request->file('profile_image')->storeAs('public/sample', $request->file('profile_image')->getClientOriginalName());

                    \Illuminate\Support\Facades\File::delete($user->profile_image);
                }else{
                    // 画像が選択されていなかったら同じ画像で処理を実行
                    $file_name = $user->profile_image;
                }
                $user->updataProfile($request, $user, $file_name);
            } catch (Exception $e) {
                return redirect()->route('profile.update.show')->with('message', '変更に失敗しました。');
                DB::rollBack();
            }
            
            DB::commit();
            return redirect()->route('profile.update.show')->with('message', 'プロフィールを更新しました。');
        }
    }

    // パスワード変更ページへ推移
    public function password_update_show() {
        //テスト用
        $user = User::find(2);
        Auth::login($user);

        // ここから本コード        
        $user = Auth::user();

        if($user === null){
            return view('userLogin');
        }else {
            return view('user_password_update')->with([
                'user' => $user,
            ]);
        }
        
    }

    // パスワード変更
    public function password_update(PasswordUpdateRequest $request) {
        //テスト用
        $user = User::find(2);
        Auth::login($user);

        // ここから本コード
        $user = Auth::user();

        if($user === null){
            return view('userLogin');
        }else {
            DB::beginTransaction();
            try {
                if($user->password === $request->old_password){
                    //更新処理
                    $user->updataPassword($request, $user);
                
                    DB::commit();
                    return redirect()->route('password.update.show')->with('message', 'パスワードを変更しました');
                }else{
                    return redirect()->route('password.update.show')->with('message', '旧パスワードでと同じパスワードは使用できません。');
                }
            } catch (Exception $e) {
                return redirect()->route('password.update.show')->with('message', '変更に失敗しました。');
                DB::rollBack();
            }
        }
    }
}
