<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AdminSeeder::class);
        //$this->call(ServiceSeeder::class);
        // $this->call(PlanSeeder::class);
        // $this->call(PackageSeeder::class);
         $this->call(ServicePackageDetailSeeder::class);
    }
}
