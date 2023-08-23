<?php

namespace App\Http\Requests\Contact;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Session;

class CreateContact extends FormRequest
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
            'full_name' => 'required',
            'email' => 'required|email',
            'phone' => [
                'required',
                'regex:/^(0)[0-9]{9,10}$/'
            ],
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Vui lòng nhập Họ tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'title.required' => 'Vui lòng chọn lý do.',
            'content.required' => 'Vui lòng nhập nội dung liên hệ.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại bắt đầu bằng số 0 và có 9-10 chữ số.'
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
