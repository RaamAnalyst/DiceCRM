<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class AppointmentActionObserver
{
    public function created(Appointment $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Appointment'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Appointment $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Appointment'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Appointment $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Appointment'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
