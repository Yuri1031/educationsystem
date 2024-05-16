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
            // 変更前のパスワード（8文字以上、特殊文字を含まない）
            'old_password' => ['required', 'min:8', 'different:current_password', 
            function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail('現在設定されているパスワードと一致しません。');
                }
            }],
            
            // 変更後のパスワード（8文字以上、変更前のパスワードと異なる）
            'new_password' => ['required', 'regex:/^[^!#$%^&*()\-_=+[\]{};:\'"<>?`~]+$/' , 'max:255', 'min:8', 'max:255', 'different:old_password'],

            // 変更後の確認用パスワード（8文字以上、変更後のパスワードと完全一致）
            'new_password_check' => ['required', 'regex:/^[^!#$%^&*()\-_=+[\]{};:\'"<>?`~]+$/' , 'max:255', 'min:8', 'max:255', 'different:old_password', 'same:new_password'],
        ];
    }

    public function messages()
{
    return [
        'old_password.required' => '変更前のパスワードを入力してください。',
        'old_password.min' => '旧パスワードは８文字以上で入力してください',
        'old_password.max' => '旧パスワードは２５５文字未満で入力してください',
        'old_password.different' => '現在設定されているパスワードと一致しません',
        'old_password.regex' => '変更前のパスワードに特殊文字は使用できません。',

        'new_password.required' => '新パスワードは入力必須項目です',
        'new_password.min' => '新パスワードは８文字以上で入力してください',
        'new_password.max' => '新パスワードは２５５文字未満で入力してください',
        'new_password.different' => '新しいパスワードは変更前のパスワードと異なる必要があります。',
        'new_password.regex' => '新パスワードは英数字で入力してください',

        'new_password_check.required' => '新パスワード（確認）は入力必須項目です',
        'new_password_check.min' => '新パスワード（確認）は８文字以上で入力してください',
        'new_password_check.max' => '新パスワード（確認）は２５５文字未満で入力してください',
        'new_password_check.same' => '新パスワード（確認）と一致しません',
        'new_password_check.regex' => '新パスワード（確認）は英数字で入力してください',
    ];
}
}