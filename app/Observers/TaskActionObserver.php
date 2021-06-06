<?php

namespace App\Observers;

use App\Models\Task;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class TaskActionObserver
{
    public function created(Task $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Task'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Task $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Task'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Task $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Task'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
