<?php

namespace Database\Seeders;
use App\Models\Package;

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $create = ([
                    [
                        'name' => 'Standard',
                        'route' => 'Standard'
                        
                    ],
                    [
                        'name' => 'Professional',
                        'route' => 'professional'
                        
                    ],
                    [
                        'name' => 'Enterprise',
                        'route' => 'enterprise'
                        
                    ]
                    
        ]);
        Package::insert($create);
    

        }
}
