<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class BlogSeeder extends Seeder
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
            $tags = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];
        for($i = 1; $i <= 10; $i ++){
                $blog = new \App\Blog();

                $blog->title = rtrim(Factory::create()->sentence(rand(3, 6)), '.');
                $blog->excerpt = Factory::create()->sentence(rand(15, 20));
                $blog->body = Factory::create()->paragraph(rand(30, 50), true);

                $blog->published_at = Carbon::now()->format('Y-m-d');
                $blog->user_id = rand(3, 4);
                $blog->image = "blogs/blog($i).jpg";

                $approvedBlog = rand(0, 1);

                if($approvedBlog){
                    $blog->approved_by = rand(1, 2);
                    $blog->approved_at = Carbon::now()->format('Y-m-d');
                }

                $blog->seo_og_title = $blog->title . " | Perks Properties";
                $blog->seo_og_description = $blog->excerpt;
                $blog->seo_keywords = $blog->title;
                $blog->seo_description = $blog->excerpt;

                

                $blog->save();
                shuffle($tags);
                for($j = 0; $j < rand(4, 9); $j++){
                    $blog->tags()->attach([$tags[$j]]);
                }
            }
        }
    }
}