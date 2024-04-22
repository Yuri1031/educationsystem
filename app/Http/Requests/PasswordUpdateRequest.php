<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 変更前のパスワード（8文字以上）
            'old_password' => 'required|min:8', 
            
            // 変更後のパスワード（8文字以上、変更前のパスワードと異なる）
            'new_password' => 'required|min:8|different:old_password', 

            // 変更後の確認用パスワード（8文字以上、変更後のパスワードと完全一致）
            'new_password_check' => 'required|min:8|same:new_password', 
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '変更前のパスワードを入力してください。',
            'old_password.min' => '変更前のパスワードは8文字以上で入力してください。',

            'new_password.required' => '新しいパスワードを入力してください。',
            'new_password.min' => '新しいパスワードは8文字以上で入力してください。',
            'new_password.different' => '新しいパスワードは変更前のパスワードと異なる必要があります。',

            'new_password_check.required' => '新しいパスワードを再入力してください。',
            'new_password_check.min' => '新しいパスワードは8文字以上で入力してください。',
            'new_password_check.same' => '新しいパスワードと再入力が一致しません。',
        ];
    }
}
