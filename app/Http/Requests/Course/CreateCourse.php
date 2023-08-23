<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourse extends FormRequest
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
            'image_pc' => 'nullable',
            'image_mobile' => 'nullable',
            'image_map' => 'nullable',
            'description' => 'nullable',
            'price' => 'nullable',
            'price_new' => 'nullable',
            'input_student' => 'nullable',
            'output_student' => 'nullable',
            'time_learn' => 'nullable',
            'who_teacher' => 'nullable',
            'how_learn' => 'nullable',
            'content_near' => 'required',
            'content_1' => 'nullable',
            'content_2' => 'nullable',
            'content_3' => 'nullable',
            'content_4' => 'nullable',
            'content_5' => 'nullable',
            'active' => 'required',
            'ordering' => 'nullable',
            'seo_title' => 'nullable',
            'seo_keyword' => 'nullable',
            'seo_description' => 'nullable',
        ];
    }
}
