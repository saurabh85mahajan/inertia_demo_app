<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'name', 'email'];

    public function department() 
    {
        return $this->belongsTo(\App\Models\Department::class);
    }

    public function scopeWhereDepartment( $query, $department_id) 
    {
        $query->when( !is_null($department_id), function($query) use ($department_id) {
            $query->where('department_id', $department_id);
        });
    }
    
}
