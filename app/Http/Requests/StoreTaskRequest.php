<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_create');
    }

    public function rules()
    {
        return [
            'task_title' => [
                'string',
                'min:1',
                'max:200',
                'required',
            ],
            'deadline'   => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
