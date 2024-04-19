<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/top';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'kana' => ['required', 'string', 'max:255', 'regex:/[ぁ-んァ-ヶー]+$/u'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'ユーザーネームは入力必須項目です',
            'kana.required' => 'カナは入力必須項目です',
            'kana.regex' => 'カナはひらがなかカタカナのみで入力してください',
            'email.required' => 'メールアドレスは入力必須項目です',
            'email.unique' => 'このメールアドレスは既に登録済みです',
            'email.email' => 'メールアドレスに「＠」を挿入してください',
            'email.max' => 'メールアドレスは完全な形式で入力してください',
            'password.required' => 'パスワードは入力必須項目です',
            'password.confirmed' => 'パスワードと、パスワード確認が、一致していません。',
            'password.min' => 'パスワードは8文字以上で指定してください',
            'password_confirmation.required' => 'パスワード確認は入力必須項目です',
        ]);
    }

    protected function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $admin = Admin::create([
                    'name' => $data['name'],
                    'kana' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
    
                return $admin;
            });
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}
