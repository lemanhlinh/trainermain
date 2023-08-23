<?php

namespace App\Http\Requests\LessonTest;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonTest extends FormRequest
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
            'name' => 'required',
            'active' => 'required',
            'description' => 'required',
            'content' => 'required',
            'number_question' => 'required',
            'time_submit' => 'required',
        ];
    }
}
