<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AggregateSale extends Model
{
    use HasFactory;

    public function scopeFromLastWeek($query) 
    {
        $today = Carbon::now()->format('Y-m-d');
        $startDate = Carbon::now()->subWeek()->format('Y-m-d');

        return $query->whereBetween('date', [$startDate, $today]);
    }

    public function scopeFromLastMonth($query) 
    {
        $today = Carbon::now()->format('Y-m-d');
        $startDate = Carbon::now()->subMonth()->format('Y-m-d');

        return $query->whereBetween('date', [$startDate, $today]);
    }
}
