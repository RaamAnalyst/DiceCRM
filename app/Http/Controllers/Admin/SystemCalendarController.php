<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'start_date',
            'field'      => 'id',
            'prefix'     => 'APPT',
            'suffix'     => 'Starts',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\Appointment',
            'date_field' => 'end_date',
            'field'      => 'id',
            'prefix'     => 'APPT',
            'suffix'     => 'Ends',
            'route'      => 'admin.appointments.edit',
        ],
        [
            'model'      => '\App\Models\Task',
            'date_field' => 'deadline',
            'field'      => 'id',
            'prefix'     => 'TSK',
            'suffix'     => 'Due',
            'route'      => 'admin.tasks.edit',
        ],
        [
            'model'      => '\App\Models\Project',
            'date_field' => 'deadline',
            'field'      => 'id',
            'prefix'     => 'PRO',
            'suffix'     => 'Due',
            'route'      => 'admin.projects.edit',
        ],
        [
            'model'      => '\App\Models\Lead',
            'date_field' => 'deadline',
            'field'      => 'id',
            'prefix'     => 'LD',
            'suffix'     => 'Due',
            'route'      => 'admin.leads.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
