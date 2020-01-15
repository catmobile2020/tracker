<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        $roles = [
            'name' => 'required',
        ];

        $user_id = auth()->id();
        $table = 'users';

        if ($this->routeIs('api.account.update'))
        {
            $roles +=['phone' => "required|unique:{$table},phone,{$user_id}"];
            $roles +=['email' => "required|unique:{$table},email,{$user_id}"];
        }

        if ($this->routeIs('api.register'))
        {
            $roles +=['phone' => "required|unique:{$table},phone"];
            $roles +=['email' => "required|unique:{$table},email"];
            $roles +=['password' => ['required',
                'min:8',
                'max:24',
                'regex:/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$/'
                    ]
            ];
        }
        return  $roles;
    }
}
