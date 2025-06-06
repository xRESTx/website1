<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password1'=>'required|min:6',
            'password2'=>'required|same:password1',
            'email'=>'required|email'
        ];
    }
    public function messages(){
        return[
            'email.email' =>'Неверный email',
            'password1.min' => 'Небезопасный пароль',
            'password2.min' => 'Небезопасный пароль',
            'password2.same'=>'Пароли не совпадают',
        ];
    }
}
