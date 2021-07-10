<?php

namespace Database\Seeders;

use App\Models\AggregateTraffic;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AggregateTrafficSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $startDate = Carbon::now();

        for($i = 1; $i <= 30; $i++) {
            $date = $startDate->subDay()->format('Y-m-d');
            AggregateTraffic::factory()->create(['date' => $date]);
        }
    }
}
