<?php

use App\Location;
use App\Property;
use App\RentDetail;
use App\Residential;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        /**
         * Using factory
         */

        // factory(App\Property::class, 50)->create();

        // factory(App\Location::class, 5)->create()->each(function($location){
        //     $location->property()->save(factory(App\Property::class, 1))->create(function($property, $location){
        //         if($property->status == "Rent")
        //         {
        //             $property->price = null;
        //             $property->slug = Str::slug(lcfirst($property->type." ".$location->id." ".$property->carpet." ".$location->city." ".$location->pincode." ".$location->state));
        //             // $property->save(factory(App\RentDetail::class, 1))->create();
        //             // if($property->type == "Residential")
        //             // {
        //             //     $property->save(factory(App\Residential::class, 1))->create();
        //             // }
        //         }
        //     });
        // });
    }
}
