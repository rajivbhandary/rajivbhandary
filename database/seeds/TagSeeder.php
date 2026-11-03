<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
            \App\Tag::create(['name' => 'customer experience']);
            \App\Tag::create(['name' => 'laravel']);
            \App\Tag::create(['name' => 'coding']);
            \App\Tag::create(['name' => 'marketing']);
            \App\Tag::create(['name' => 'statistics']);
            \App\Tag::create(['name' => 'php']);
            \App\Tag::create(['name' => 'java']);
            \App\Tag::create(['name' => 'c sharp']);
            \App\Tag::create(['name' => 'c']);
            \App\Tag::create(['name' => 'learning']);
            \App\Tag::create(['name' => 'machine learning']);
            \App\Tag::create(['name' => 'artificial intelligence']);
            \App\Tag::create(['name' => 'study link']);
            \App\Tag::create(['name' => 'creativity']);
            \App\Tag::create(['name' => 'ui']);
            \App\Tag::create(['name' => 'ux']);
            \App\Tag::create(['name' => 'programming']);
            \App\Tag::create(['name' => 'scripting']);
            \App\Tag::create(['name' => 'covid-19']);
            \App\Tag::create(['name' => 'careeroption']);
            \App\Tag::create(['name' => 'cleancoding']);
            \App\Tag::create(['name' => 'figma']);
            \App\Tag::create(['name' => 'adobexd']);
            \App\Tag::create(['name' => 'privacy']);
            \App\Tag::create(['name' => 'security']);
            \App\Tag::create(['name' => 'developer']);
            \App\Tag::create(['name' => 'java developer']);
        }
    }
}
