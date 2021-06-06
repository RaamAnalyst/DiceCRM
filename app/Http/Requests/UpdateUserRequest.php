<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name'         => [
                'string',
                'required',
            ],
            'email'        => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'roles.*'      => [
                'integer',
            ],
            'roles'        => [
                'required',
                'array',
            ],
            'address'      => [
                'string',
                'min:1',
                'max:200',
                'nullable',
            ],
            'phone_number' => [
                'string',
                'min:1',
                'max:20',
                'nullable',
            ],
        ];
    }
}
