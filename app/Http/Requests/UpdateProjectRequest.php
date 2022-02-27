<?php

namespace App\Http\Requests;

use App\Models\Project;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProjectRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('project_edit');
    }

    public function rules()
    {
        return [
            'project_title' => [
                'string',
                'min:1',
                'max:200',
                'required',
            ],
            'deadline' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'project_docs' => [
                'array',
            ],
        ];
    }
}
