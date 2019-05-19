<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'article/new' || 'article/edit'){
          return true;
        } else {
          return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'title' => 'required',
           'contents' => 'required',//
        ];
    }
    public function messages()
    {
        return [
           'title.required' => 'タイトルは必須です',
           'contents.required' => '本文は必須です',//
        ];
    }
}
