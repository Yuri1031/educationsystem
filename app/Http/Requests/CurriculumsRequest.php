<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumsRequest extends FormRequest
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
            'title' =>'required|max:255',
            'description'=>'max:2000',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => '授業名は必須項目です。',
            'title.max' => '授業名は255文字以内で入力してください。',
            'description.max' => '授業概要は2000文字以内で入力してください。',
            'thumbnail_image.image' => '商品画像は画像ファイルを選択してください。',
            'thumbnail_image.mimes' => '商品画像はjpeg、png、jpg、gif形式の画像ファイルを選択してください。',
            'thumbnail_image.max' => '商品画像のサイズは2MB以下にしてください。',
        ];
    }
}
