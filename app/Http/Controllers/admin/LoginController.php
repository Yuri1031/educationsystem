<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    protected $redirectTo = '/admin/top';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('admin/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => 'メールアドレスを正しく入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードを8文字以上で入力してください。',
        ]);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('ログイン情報が登録されていません。')],
        ]);
    }
}
