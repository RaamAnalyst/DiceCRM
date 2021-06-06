<?php

namespace App\Observers;

use App\Models\Lead;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class LeadActionObserver
{
    public function created(Lead $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Lead'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Lead $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Lead'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Lead $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Lead'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
