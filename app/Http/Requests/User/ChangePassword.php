<?php

namespace App\Http\Requests\User;

use App\Rules\User\Password\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePassword extends FormRequest
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
            'current_password' => ['required', 'string', new CurrentPassword()],
            'password' => 'required|string|min:8|max:100|confirmed',
            'password_confirmation' => 'required|string'
        ];
    }
}
