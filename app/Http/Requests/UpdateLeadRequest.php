<?php

namespace App\Http\Requests;

use App\Models\Lead;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLeadRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lead_edit');
    }

    public function rules()
    {
        return [
            'lead_title' => [
                'string',
                'min:1',
                'max:200',
                'required',
            ],
            'deadline' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'qualified' => [
                'required',
            ],
            'leads_doc' => [
                'array',
            ],
        ];
    }
}
