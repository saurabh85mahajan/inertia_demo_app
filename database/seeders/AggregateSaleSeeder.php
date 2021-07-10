<?php

namespace Database\Seeders;

use App\Models\AggregateSale;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AggregateSaleSeeder extends Seeder
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
            AggregateSale::factory()->create(['date' => $date]);
        }
    }
}
