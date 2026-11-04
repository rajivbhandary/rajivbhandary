<?php

namespace App\Http\Controllers\frontend;

use App\Blog;
use App\Config;
use App\Http\Controllers\Controller;
use App\Page;
use App\Tag;
use Illuminate\Support\Facades\Request;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::withoutTrashed()->approved()->published()->latest('published_at')->searchTitle(request('search'))->paginate(6);
        $blog_count = Blog::withoutTrashed()->approved()->published()->latest('published_at')->searchTitle(request('search'))->count();
        $config = Config::first();
        $page_seo = Page::where('route_name', Request::route()->getName())->first();
        
        return view('frontend.blogs-list', compact([
            'blogs',
            'page_seo',
            'config',
            'blog_count',
        ]));
    }

    public function show(Blog $blog)
    {
        if($blog->isApproved() && $blog->isPublished()) {
            $tags = Tag::all();
            $latest_blogs = Blog::withoutTrashed()->latest('published_at')->approved()->published()->where('id', '!=', $blog->id)->limit(3)->get();
            $config = Config::first();
            return view('frontend.single-blog', compact([
                'tags',
                'blog',
                'latest_blogs',
                'config',
            ]));
        }else{
            abort(404);
        }
    }

    public function tag(Tag $tag){
        // Only approved, published posts appear publicly.
        $blogs = $tag->blogs()->approved()->published()->latest('published_at')->searchTitle(request('search'))->paginate(6);
        $blog_count = $tag->blogs()->approved()->published()->searchTitle(request('search'))->count();
        $config = Config::first();
        $page_seo = Page::where('route_name', "frontend.blogs")->first();
        return view('frontend.blogs-list', compact([
            'blogs',
            'blog_count',
            'config',
            'page_seo',
            'tag',
        ]));
    }
}
