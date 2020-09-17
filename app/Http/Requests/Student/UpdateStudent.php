<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudent extends FormRequest
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
            'fullname' => ['required', 'string', 'max: 255'],
            'email' => ['required', 'string', 'email', 'unique:users,email,' . $this->user_id, 'max: 255'],
            'birthday' => ['required'],
            'gender' => ['required'],
            'phone_number' => ['required', 'regex:/^((03|09|07|08)[0-9]{8})$/'],
            'address' => ['required', 'max: 255'],
            'avatar' => ['mimes:jpeg,bmp,png,jpg,gif,svg', 'max:2000']
        ];
    }
}
