<?php

namespace App\Http\Controllers;

use App\Models\AggregateCustomer;
use App\Models\AggregateSale;
use App\Models\AggregateTraffic;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {

        return Inertia::render('Dashboard/Index', [

            'sales' => function () {
                $sales = AggregateSale::query()
                    ->when(Request::get('period', 'weekly') == 'weekly', function ($query) {
                        return $query->fromLastWeek();
                    })
                    ->when(Request::get('period', 'weekly') == 'monthly', function ($query) {
                        return $query->fromLastMonth();
                    })
                    ->orderBy('date', 'ASC')
                    ->get()
                    ->transform(function ($s) {
                        return [
                            'date' => Carbon::create($s->date)->format('j M'),
                            'count' => $s->total_sales
                        ];
                    });
                return [
                    'date' => $sales->pluck('date'),
                    'count' => $sales->pluck('count'),
                ];
            },
            'customers' => function () {
                $customers = AggregateCustomer::query()
                    ->when(Request::get('period', 'weekly') == 'weekly', function ($query) {
                        return $query->fromLastWeek();
                    })
                    ->when(Request::get('period', 'weekly') == 'monthly', function ($query) {
                        return $query->fromLastMonth();
                    })
                    ->orderBy('date', 'ASC')
                    ->get()
                    ->transform(function ($s) {
                        return [
                            'date' => Carbon::create($s->date)->format('j M'),
                            'count' => $s->total_customers
                        ];
                    });
                return [
                    'date' => $customers->pluck('date'),
                    'count' => $customers->pluck('count'),
                ];
            },
            'traffic' => function () {
                $traffic =  AggregateTraffic::query()
                    ->when(Request::get('period', 'weekly') == 'weekly', function ($query) {
                        return $query->fromLastWeek();
                    })
                    ->when(Request::get('period', 'weekly') == 'monthly', function ($query) {
                        return $query->fromLastMonth();
                    })
                    ->orderBy('date', 'ASC')
                    ->get()
                    ->transform(function ($s) {
                        return [
                            'date' => Carbon::create($s->date)->format('j M'),
                            'count' => $s->total_hits
                        ];
                    });
                return [
                    'date' => $traffic->pluck('date'),
                    'count' => $traffic->pluck('count'),
                ];
            },
        ]);
    }
}
