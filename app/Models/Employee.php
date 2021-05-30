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
    
}
