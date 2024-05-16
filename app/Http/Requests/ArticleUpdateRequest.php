<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'posted_date' => 'required',
            'title' => ['required', 'max:255', 'regex:/^[^!@#$%^&*()\-_=+[\]{};:\'"<>?`~]+$/'],
            'article_contents' => ['required', 'regex:/^[^!#$%^&*()\-_=+[\]{};:\'"<>?`~]+$/'],
        ];
    }

    public function messages()
    {
        return [
            'posted_date.required' => '投稿日時は入力必須項目です',
            'title.required' => 'タイトルは入力必須項目です',
            'title.max' => 'タイトルは２５５文字未満で入力してください',
            'title.regex' => 'タイトルを正しく入力してください',
            'article_contents.required' => '本文は入力必須項目です',
            'article_contents.regex' => '本文を正しく入力してください',
        ];
    }
}
