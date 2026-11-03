<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Date;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'realtor' => $faker->name(), 
        'building_name' => $faker->words(2, true),
        'street' => $faker->streetName(),
        'landmark' => $faker->words(2, true),
        'locality' => $faker->words(3, true),
        'town' => $faker->words(1, true),
        'city' => $faker->city(),
        'pincode' => "400075",
        'state' => $faker->state(),
        'country' => $faker->country(),
        'latitude' => "19.183749",
        'longitude' => "72.948013",
        'created_at' => Date::create(2021, rand(3, 6), rand(1, 30))
    ];
});
