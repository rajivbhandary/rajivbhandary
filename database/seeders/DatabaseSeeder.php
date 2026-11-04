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
        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(FRESeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(EnquirySeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ConfigSeeder::class);
    }
}
