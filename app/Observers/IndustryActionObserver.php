<?php

namespace App\Observers;

use App\Models\Industry;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class IndustryActionObserver
{
    public function created(Industry $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Industry'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Industry $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Industry'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Industry $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Industry'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
