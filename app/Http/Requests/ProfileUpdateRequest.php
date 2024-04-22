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
            'user_name' => 'required', 
            'user_name_kana' => 'required|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u', 
            'email' => 'required', 
        ];
    }

    public function messages() {
        return [
            'user_name.required' => 'ユーザーネームを入力してください。',
            'user_name_kana.required' => 'ユーザーネーム（カナ）を入力してください。',
            'user_name_kana.regex' => 'カタカナで入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
        ];
    }
}
