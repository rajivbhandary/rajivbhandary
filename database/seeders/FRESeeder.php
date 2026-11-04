<?php

namespace Database\Seeders;

use App\Developer;
use App\FRE;
use App\FREAmenity;
use App\FREOverviewKeypoint;
use App\FRESurrounding;
use App\Image;
use App\ImageFRE;
use App\Location;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FRESeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment(['local', 'testing']))
        {
            $freLocality = ['V.P Road', 'L.B.S Marg', 'R.R.T Road', 'Bhakti Marg', 'M.G Road'];
            $freTown = ['Mulund', 'Thane', 'Bhandup', 'Nahur', 'Airoli'];
            for($f = 1; $f < 6; $f++){
                $location = new Location();
                $developer = new Developer();

                $location->building_name =  Str::random(10) . " Developers";
                $location->street = Str::random(10);
                $location->landmark = Str::random(10);
                $location->locality = $freLocality[$f-1];
                $location->town = $freTown[$f-1];
                $location->city = "Mumbai";
                $location->pincode = "400080";
                $location->state = Str::random(10);
                $location->country = "India";
                $location->latitude = "19.183574827638175";
                $location->longitude = "72.94943247354243";

                $location->save();


                $developer->name = Str::random(10) . " Developers";
                $developer->rera_number = Str::random(12);
                $developer->info = Factory::create()->paragraph(rand(1, 3), true);

                $developer->save();

                $fre = new FRE();

                $fre->location_id = $location->id;
                $fre->developer_id = $developer->id;
                $fre->title = Factory::create()->sentence(rand(5, 10));
                $fre->slug = Str::slug(lcfirst($fre->title));
                $fre->overview = Factory::create()->paragraph(rand(1, 3), true);
                $fre->commercial_space = Factory::create()->sentence(rand(3, 4));
                $fre->possesion_date = Carbon::now()->format('Y-m-d');
                $fre->rera_number = Str::random(12);
                $fre->total_price = rand(1000000, 500000);
                $fre->minimum_investment = (string)rand(10000, 500000);
                $fre->rental_yield = (string)rand(5, 10);
                $fre->gross_yield = (string)rand(5, 10);
                $fre->expected_irr = (string)rand(5, 10);
                $fre->target_multiplier = (string)rand(5, 10);
                $fre->details_info = Factory::create()->paragraph(rand(1, 3), true);
                $fre->floor_plate = (string)rand(4, 10);
                $fre->floor = (string)rand(1, 10);
                $fre->feature_image_path = "fres-feature-image/$f.jpg";
                $fre->car_parking =  (string)rand(5, 10);
                $fre->elevators = (string)rand(1, 5);
                $fre->built_up_area = (string)rand(10000, 11000);
                $fre->carpet_area = "10000";
                $fre->property_type = Str::random(5);
                $fre->tenant_overview = Factory::create()->paragraph(rand(1, 3), true);
                $fre->founded = (string)rand(1900, 2021);
                $fre->industry = Str::random(5);
                $fre->market_cap = "250000";
                $fre->employees = (string)rand(100, 3500);
                $fre->seo_description = $fre->title . " | Perks Properties";
                $fre->Seo_keywords = $fre->overview;
                $fre->seo_og_title = $fre->title;
                $fre->seo_og_description = $fre->overview;

                $fre->save();

                for($i=0; $i<3; $i++){
                    $freOverviewKeypoint = new FREOverviewKeypoint();
                    $freOverviewKeypoint->name = Str::random(5);
                    $freOverviewKeypoint->f_r_e_id = $fre->id;
                    $freOverviewKeypoint->save();

                    $freAmenity = new FREAmenity(); 
                    $freAmenity->name = Str::random(5);
                    $freAmenity->f_r_e_id = $fre->id;
                    $freAmenity->save();

                    $freSurroundings = new FRESurrounding();
                    $freSurroundings->name = Str::random(5);
                    $freSurroundings->f_r_e_id = $fre->id;
                    $freSurroundings->save();

                }

                for($i=1; $i<6; $i++){
                    $image = Image::create([
                        'path' => "fres/$i.jpg"
                    ]);
                    // dd($image->path); ye aa raha hae
        
                    ImageFRE::create([
                        'image_id' => $image->id,
                        'f_r_e_id' => $fre->id
                    ]);
                }
            }
        
        }
    }
}
