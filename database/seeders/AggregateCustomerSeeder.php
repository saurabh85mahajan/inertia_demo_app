<?php

namespace Database\Seeders;

use App\Models\AggregateCustomer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AggregateCustomerSeeder extends Seeder
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
            AggregateCustomer::factory()->create(['date' => $date]);
        }
    }
}
