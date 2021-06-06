<?php

namespace App\Observers;

use App\Models\Client;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ClientActionObserver
{
    public function created(Client $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Client'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Client $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Client'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Client $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Client'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
