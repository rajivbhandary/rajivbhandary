<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(ENV('APP_ENV') == 'local')
        {
            \App\User::create([
                'name' => 'Demo Super Admin',
                'email' => 'superadmin@example.com',
                'phone_number' => '9876543210',
                'image' => 'users/user1.jpg',
                'password' => Hash::make(env('SEED_USER_PASSWORD', 'local-dev-only')),
                'role' => 'super-admin',
                'about' => '"LIVE as if you were to DIE tomorrow, LEARN as if you were to live forever..." Forever a student of technology. A programmer who fixes problems that you don’t know you have, in a way you don’t understand.'
            ]);

            \App\User::create([
                'name' => 'Demo Admin',
                'email' => 'admin@example.com',
                'phone_number' => '9876543211',
                'image' => 'users/user2.jpg',
                'password' => Hash::make(env('SEED_USER_PASSWORD', 'local-dev-only')),
                'role' => 'admin',
                'about' => 'Born to express, not to impress. Living vicariously through myself. Due to an intense mind fog, all of my thoughts have been grounded until further notice.'
            ]);


            \App\User::create([
                'name' => 'Demo Author',
                'email' => 'author1@example.com',
                'phone_number' => '9876543213',
                'image' => 'users/user3.jpg',
                'password' => Hash::make(env('SEED_USER_PASSWORD', 'local-dev-only')),
                'role' => 'author',
                'about' => 'I write and talk about almost everything from tech to fiction. It differs from how much interest the topic holds. What do you want to talk about over coffee?'
            ]);

            \App\User::create([
                'name' => 'Second Author',
                'email' => 'author2@example.com',
                'phone_number' => '9876543214',
                'image' => 'users/user4.jpg',
                'password' => Hash::make(env('SEED_USER_PASSWORD', 'local-dev-only')),
                'role' => 'author',
                'about' => 'Content Writer & blogger at Studylink. Using blogs as my best networking tool and creating content that truly counts. In love with blogging and Sundae Sundays!',
            ]);
        }

    }
}
