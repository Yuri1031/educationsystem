<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'user_name' => 'required|max:255', 
            'user_name_kana' => 'required|max:255|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u', 
            'email' => ['required', 'regex:/^[^!#$%^&*()\-_=+[\]{};:\'"<>?`~]+$/' , 'max:255'], 
        ];
    }

    public function messages() {
        return [
            'user_name.required' => 'ユーザーネームは入力必須項目です',
            'user_name.max' => 'ユーザーネームは２５５文字未満で入力してください',
            'user_name_kana.required' => 'ユーザーネーム（カタカナ）は入力必須項目です',
            'user_name_kana.max' => 'ユーザーネーム（カタカナ）は２５５文字未満で入力してください',
            'user_name_kana.regex' => 'カタカナで入力してください。',
            'email.required' => 'メールアドレスは入力必須項目です',
            'email.max' => 'メールアドレスは２５５文字未満で入力してください',
            'email.regex' => 'メールアドレスはメールアドレス形式で入力してください',
        ];
    }
}
