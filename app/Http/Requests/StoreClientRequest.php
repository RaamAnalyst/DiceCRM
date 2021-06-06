<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_create');
    }

    public function rules()
    {
        return [
            'contact_name'   => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'contact_email'  => [
                'required',
            ],
            'contact_number' => [
                'string',
                'min:1',
                'max:20',
                'required',
            ],
            'gst_vat'        => [
                'string',
                'min:1',
                'max:30',
                'required',
            ],
            'company_name'   => [
                'string',
                'min:1',
                'max:50',
                'required',
            ],
            'address'        => [
                'string',
                'min:1',
                'max:250',
                'required',
            ],
            'zipcode'        => [
                'string',
                'min:1',
                'max:10',
                'nullable',
            ],
            'city'           => [
                'string',
                'min:1',
                'max:20',
                'nullable',
            ],
            'company_type'   => [
                'string',
                'min:1',
                'max:20',
                'nullable',
            ],
        ];
    }
}
