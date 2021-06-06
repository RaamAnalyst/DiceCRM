<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Client extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'clients';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_number',
        'gst_vat',
        'company_name',
        'address',
        'zipcode',
        'city',
        'industry_id',
        'company_type',
        'department_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        Client::observe(new \App\Observers\ClientActionObserver);
    }

    public function assignClientProjects()
    {
        return $this->hasMany(Project::class, 'assign_client_id', 'id');
    }

    public function assignClientTasks()
    {
        return $this->hasMany(Task::class, 'assign_client_id', 'id');
    }

    public function assignClientLeads()
    {
        return $this->hasMany(Lead::class, 'assign_client_id', 'id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
