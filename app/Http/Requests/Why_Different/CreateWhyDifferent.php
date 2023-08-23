<?php

namespace App\Http\Requests\Why_Different;

use Illuminate\Foundation\Http\FormRequest;

class CreateWhyDifferent extends FormRequest
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
            'icon' => 'required',
            'description' => 'required',
            'content' => 'required',
            'display_page' => 'required',
            'active' => 'required',
            'ordering' => 'nullable'
        ];
    }
}
