<?php

namespace App\Http\Requests\QuestionTest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionTest extends FormRequest
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
            'lesson_id' => 'required',
            'active' => 'required',
            'content' => 'required',
            'type_id' => 'required',
            'level' => 'required',
            'answer' => 'required_without_all',
            'answer_true' => 'required',
        ];
    }
}
