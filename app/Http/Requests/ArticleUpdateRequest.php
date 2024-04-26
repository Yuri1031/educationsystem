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
            'title' => 'required|max:30',
            'article_contents' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'posted_date.required' => '投稿日を選択してください',
            'title.required' => 'タイトルを入力してください',
            'article_contents.required' => '本文を入力してください',
            'article_contents.max' => '30文字以内で入力してください。',
        ];
    }
}
