<?php

namespace App\Observers;

use App\Models\Department;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class DepartmentActionObserver
{
    public function created(Department $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Department'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(Department $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'Department'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(Department $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'Department'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
