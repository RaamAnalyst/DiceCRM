<?php

namespace App\Observers;

use App\Models\Status;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class StatusActionObserver
{
    public function created(Status $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Status'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Status $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Status'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Status $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Status'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
