<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|min:3',
            'last_name'=> 'required|min:3',
            'username' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:5',
            'password' => ['required','confirmed',Password::min(8)->mixedCase()->numbers()],
        ];
    }
}
