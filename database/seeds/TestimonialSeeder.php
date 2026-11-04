<?php

use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
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
            \App\Testimonial::create([
                'name' => 'Karuna Kukreja',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/1.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Dhiren Chotwani',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/2.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Khushboo Chandnani',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/3.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Nikhil Ghind',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/4.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Varun Jethanandani',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/5.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Akshay Navani',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/6.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Animesh Ghosh',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/7.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Jaynam Sanghvi',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/8.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Dhananjay Ghumare',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/9.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Pratik Tiwari',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/10.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Aniket Konkar',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/11.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Nikhil Shadija',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/12.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Piyush Kukreja',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/13.png',
            ]);

            \App\Testimonial::create([
                'name' => 'Jatin Valyrani',
                'city' => 'Mumbai',
                'testimonial' => '<p class="mb-0 ml-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia doloribus alias nostrum iure ipsam quia autem ex ab quo ratione, ad quibusdam praesentium quaerat, culpa voluptatibus distinctio, suscipit dolore atque. Lorem ipsum dolor, sit amet consectetur adipisicing elit.!</p>',
                'image' => 'testimonials/14.png',
            ]);
        }

       
    }
}
