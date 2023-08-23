<?php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class CreatePage extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'nullable',
            'image' => 'nullable',
            'description' => 'required',
            'content' => 'required',
            'active' => 'required',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
