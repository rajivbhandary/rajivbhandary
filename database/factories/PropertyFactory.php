<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Property;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Date;

$factory->define(Property::class, function (Faker $faker) {
    $month = rand(1, 12);
    return [
        'location_id' => 1,
        'slug' => 'random-slug',
        'status' => "Sell",
        'type' => "Commercial",
        'detailed_type' => "Workspace",
        'rent_detail_id' => null,
        'number_of_bathrooms' => rand(2, 4),
        'total_floors' => 14,
        'floor_number' => rand(0, 14),
        'age_of_property' => rand(1, 10),
        'carpet' => rand(510, 890),
        'price' => 500000,
        'negotiable' => rand(0, 1),
        'under_construction' => 0,
        'owner_name' => $faker->name(),
        'owner_email' => $faker->email(),
        'owner_phone_number' => $faker->phoneNumber(),
        'description' => $faker->paragraphs(rand(3, 7), true),
        'feature_image_path' => 'properties-feature-image/1.jpg',
        'created_at' => "23-$month-2021"
    ];
});
