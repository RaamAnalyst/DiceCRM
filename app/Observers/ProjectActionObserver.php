<?php

namespace App\Observers;

use App\Models\Project;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ProjectActionObserver
{
    public function created(Project $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Project'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Project $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Project'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Project $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Project'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
