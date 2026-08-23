<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'code',
        'logo_path',
        'tax_id',
        'address',
        'phone',
        'email',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
