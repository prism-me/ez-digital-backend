<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create(
            [
                'name' => 'SEO Services',
                'route' => 'seo'
            ],
            [
                'name' => 'WEB Development',
                'route' => 'web-development'
            ],
            [
                'name' => 'Social Media Marketing',
                'route' => 'social-media-marketing'
            ],
            [
                'name' => 'Paid Advertising',
                'route' => 'paid-advertising'
            ],
            [
                'name' => 'Copy Writing',
                'route' => 'copy-writing'
            ],
            [
                'name' => 'WhatsApp Business',
                'route' => 'whatsapp-for-business'
            ]
        );
    }
}
