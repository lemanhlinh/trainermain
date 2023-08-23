<?php

namespace App\Http\Requests\Advisory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Session;

class CreateAdvisory extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => [
                'required',
                'regex:/^(0)[0-9]{9,10}$/'
            ],
            'why_learn_ielts' => 'required',
            'time_ielts_support' => 'required',
            'test_ielts_address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng nhập Họ tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại bắt đầu bằng số 0 và có 9-10 chữ số.',
            'why_learn_ielts.required' => 'Vui lòng chọn điểm mong muốn.',
            'time_ielts_support.required' => 'Vui lòng thời gian.',
            'test_ielts_address.required' => 'Vui lòng trung tâm.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors();
        if ($message->first()){
            Session::flash('danger', trans($message->first()));
        }

        if ($this->expectsJson()) {
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        }
        parent::failedValidation($validator);
    }
}
