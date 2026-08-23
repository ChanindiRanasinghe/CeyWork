<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'company_id',
        'department_id',
        'reporting_manager_id',
        'employee_code',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'nic_passport',
        'dob',
        'gender',
        'designation',
        'branch',
        'cost_center',
        'grade',
        'contract_type',
        'joined_date',
        'status',
        'basic_salary',
        'epf_number',
        'etf_number',
        'b_card_no',
        'bank_name',
        'bank_branch',
        'bank_account_no',
        'emergency_contact_name',
        'emergency_contact_phone',
        'custom_fields',
    ];

    protected $casts = [
        'dob' => 'date',
        'joined_date' => 'date',
        'custom_fields' => 'array',
        'basic_salary' => 'decimal:2',
    ];

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function reportingManager()
    {
        return $this->belongsTo(Employee::class, 'reporting_manager_id');
    }

    public function directReports()
    {
        return $this->hasMany(Employee::class, 'reporting_manager_id');
    }
}
