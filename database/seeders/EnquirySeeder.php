<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EnquirySeeder extends Seeder
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
            $id = [1, 2, 3, 4, 5];
            $modelArray = ['App\FRE', 'App\Property', null];
            for($i=0; $i<10; $i++)
            {
                $enquiry = new \App\Enquiry();
                $model = $modelArray[rand(0, 2)];
                $enquiry->model = $model;
                if($model == null)
                {
                    $enquiry->model_id = null;
                }else{
                    $enquiry->model_id = $id[rand(0, 4)];
                }
                $enquiry->name = Str::random(5);
                $enquiry->phone_number = "9843137211";
                $enquiry->email = Str::random(5)."@example.com";
                $enquiry->city = Str::random(5);
                $enquiry->state = Str::random(5);
                $enquiry->message = Str::random(10);

                $enquiry->save();
            }
        }
    }
}
