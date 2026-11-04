<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Config::create([
            'default_seo_author' => 'Perks Properties',
            'default_seo_description' => 'Perks Properties helps you find out the best property at your favourite locations',
            'default_seo_keywords' => '1BHK,2BHK.3BHK, 4BHK, Penthouse
            Garden,Swimming Pool, Balcony, Terrace
            Hill View, Sea Facing, Furnished, Unfurnished,1 bathroom, 2 bathrooms...
            Verandah, Garage, Parking Available, Store Room, Pooja Room, Elevator,
            Bath Tub, Data Rack, Utility Room, Conference Room, Centralized AirConditioning,',
            'default_seo_og_title' => 'Perks Properties',
            'default_seo_og_description' => 'Perks Properties helps you find out the best property at your favourite locations',
        ]);
    }
}
