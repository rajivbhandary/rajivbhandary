<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Config;
use App\Http\Controllers\Controller;
use App\Page;
use App\Tag;
use Illuminate\Http\Request;

class PreviewsController extends Controller
{
    public function previewBlogs()
    {
        // filter() limits authors to their own posts.
        $blogs = Blog::withoutTrashed()->filter()->latest('published_at')->searchTitle(request('search'))->paginate(6);
        $blog_count = Blog::withoutTrashed()->filter()->searchTitle(request('search'))->count();
        $config = Config::first();
        $page_seo = Page::where('route_name', \Illuminate\Support\Facades\Request::route()->getName())->first();
        return view('admin.blogs.preview', compact([
            'blogs',
            'page_seo',
            'config',
            'blog_count',
        ]));
    }

    public function previewSingleBlog(Blog $blog)
    {
        $this->authorize('view', $blog);

        $tags = Tag::all();
        $latest_blogs = Blog::withoutTrashed()->latest('published_at')->where('id', '!=',$blog->id)->limit(3)->get();
        $blogs = Blog::withoutTrashed()->latest('published_at')->get();
        // $views = $request->visitor()->visit($blog);
        $blogIds = Blog::withoutTrashed()->latest('published_at')->get()->pluck('id')->toArray();
        $config = Config::first();
        return view('admin.blogs.show', compact([
            'tags',
            'blogs',
            'blog',
            'latest_blogs',
            'config',
        ]));
    }

    public function previewBlogsOfTag(Tag $tag){
        $blogs = $tag->blogs()->filter()->latest('published_at')->searchTitle(request('search'))->paginate(6);
        $blog_count = $tag->blogs()->filter()->searchTitle(request('search'))->count();
        $config = Config::first();
        $page_seo = Page::where('route_name', "frontend.blogs")->first();
        return view('admin.blogs.preview', compact([
            'blogs',
            'blog_count',
            'config',
            'page_seo',
        ]));
    }
}
