<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'client_create',
            ],
            [
                'id'    => 18,
                'title' => 'client_edit',
            ],
            [
                'id'    => 19,
                'title' => 'client_show',
            ],
            [
                'id'    => 20,
                'title' => 'client_delete',
            ],
            [
                'id'    => 21,
                'title' => 'client_access',
            ],
            [
                'id'    => 22,
                'title' => 'industry_create',
            ],
            [
                'id'    => 23,
                'title' => 'industry_edit',
            ],
            [
                'id'    => 24,
                'title' => 'industry_show',
            ],
            [
                'id'    => 25,
                'title' => 'industry_delete',
            ],
            [
                'id'    => 26,
                'title' => 'industry_access',
            ],
            [
                'id'    => 27,
                'title' => 'department_create',
            ],
            [
                'id'    => 28,
                'title' => 'department_edit',
            ],
            [
                'id'    => 29,
                'title' => 'department_show',
            ],
            [
                'id'    => 30,
                'title' => 'department_delete',
            ],
            [
                'id'    => 31,
                'title' => 'department_access',
            ],
            [
                'id'    => 32,
                'title' => 'status_create',
            ],
            [
                'id'    => 33,
                'title' => 'status_edit',
            ],
            [
                'id'    => 34,
                'title' => 'status_show',
            ],
            [
                'id'    => 35,
                'title' => 'status_delete',
            ],
            [
                'id'    => 36,
                'title' => 'status_access',
            ],
            [
                'id'    => 37,
                'title' => 'project_create',
            ],
            [
                'id'    => 38,
                'title' => 'project_edit',
            ],
            [
                'id'    => 39,
                'title' => 'project_show',
            ],
            [
                'id'    => 40,
                'title' => 'project_delete',
            ],
            [
                'id'    => 41,
                'title' => 'project_access',
            ],
            [
                'id'    => 42,
                'title' => 'task_create',
            ],
            [
                'id'    => 43,
                'title' => 'task_edit',
            ],
            [
                'id'    => 44,
                'title' => 'task_show',
            ],
            [
                'id'    => 45,
                'title' => 'task_delete',
            ],
            [
                'id'    => 46,
                'title' => 'task_access',
            ],
            [
                'id'    => 47,
                'title' => 'lead_create',
            ],
            [
                'id'    => 48,
                'title' => 'lead_edit',
            ],
            [
                'id'    => 49,
                'title' => 'lead_show',
            ],
            [
                'id'    => 50,
                'title' => 'lead_delete',
            ],
            [
                'id'    => 51,
                'title' => 'lead_access',
            ],
            [
                'id'    => 52,
                'title' => 'appointment_create',
            ],
            [
                'id'    => 53,
                'title' => 'appointment_edit',
            ],
            [
                'id'    => 54,
                'title' => 'appointment_show',
            ],
            [
                'id'    => 55,
                'title' => 'appointment_delete',
            ],
            [
                'id'    => 56,
                'title' => 'appointment_access',
            ],
            [
                'id'    => 57,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 58,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 59,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 60,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 61,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 62,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 63,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
