<?php

namespace Database\Seeders;
use App\Models\Plan;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create(
            [
                'name' => 'Monthly',
                'route' => 'monthly',
                
            ],
            [
                'name' => 'Yearly',
                'route' => 'yearly',
                
            ]
        );
    }
}
