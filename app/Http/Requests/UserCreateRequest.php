<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\VerifyEmailBlocked; 

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true
        ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => ['required','min:2'],
            'email'             => ['required', 'email', new VerifyEmailBlocked('user1@gmail.com')],
            'password'          => ['required','confirmed'],
            'password-confirm'  => [ 'same:password' ],            
        ];
    }

     
}