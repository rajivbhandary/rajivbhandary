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
                'name' => 'Shraddha Keniya',
                'email' => 'shraddhakeniya@gmail.com',
                'phone_number' => '9876543210',
                'image' => 'users/user1.jpg',
                'password' => Hash::make('abcd1234'),
                'role' => 'super-admin',
                'facebook_id' => 'shraddha.keniya.3114',
                'instagram_id' => 'shraddha-keniya',
                'linked_in_id' => 'shraddha-keniya-01',
                'about' => '"LIVE as if you were to DIE tomorrow, LEARN as if you were to live forever..." Forever a student of technology. A programmer who fixes problems that you don’t know you have, in a way you don’t understand.'
            ]);

            \App\User::create([
                'name' => 'Sakshi Shah',
                'email' => 'sakshidshah24@gmail.com',
                'phone_number' => '9876543211',
                'image' => 'users/user2.jpg',
                'password' => Hash::make('abcd1234'),
                'role' => 'admin',
                'facebook_id' => 'shah.sakshi.12',
                'instagram_id' => 'sakshi_shah_24',
                'about' => 'Born to express, not to impress. Living vicariously through myself. Due to an intense mind fog, all of my thoughts have been grounded until further notice.'
            ]);


            \App\User::create([
                'name' => 'Harsh Kothari',
                'email' => 'harsh.kothari@gmail.com',
                'phone_number' => '9876543213',
                'image' => 'users/user3.jpg',
                'password' => Hash::make('abcd1234'),
                'role' => 'author',
                'facebook_id' => 'harshkothari28',
                'instagram_id' => '_harsh_kothari',
                'linked_in_id' => 'harsh-kothari-04',
                'about' => 'I write and talk about almost everything from tech to fiction. It differs from how much interest the topic holds. What do you want to talk about over coffee?'
            ]);

            \App\User::create([
                'name' => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'phone_number' => '9876543214',
                'image' => 'users/user4.jpg',
                'password' => Hash::make('abcd1234'),
                'role' => 'author',
                'facebook_id' => 'johndoe',
                'instagram_id' => 'johndoe',
                'linked_in_id' => 'john-doe',
                'about' => 'Content Writer & blogger at Studylink. Using blogs as my best networking tool and creating content that truly counts. In love with blogging and Sundae Sundays!',
            ]);
        }

    }
}
