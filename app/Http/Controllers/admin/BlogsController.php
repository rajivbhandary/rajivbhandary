<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blogs\CreateBlogRequest;
use App\Http\Requests\Blogs\UpdateBlogRequest;
use App\Tag;
use Illuminate\Support\Facades\Storage;



class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Blog::class);
        return view('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Blog::class);
        $tags = Tag::all();
        return view('admin.blogs.create', compact([
            'tags'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlogRequest $request)
    {
        $this->authorize('create', Blog::class);

        if(!Storage::exists('blog-detail-images/')){
            Storage::makeDirectory("blog-detail-images/");
        }
        $image = $request->file('image')->store('blogs');
        $blog = Blog::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'user_id' => auth()->id(),
            'image' => $image,
            'published_at' => $request->published_at,
            'seo_description' => $request->seo_description ?? null,
            'seo_keywords' => $request->seo_keywords ?? null,
            'seo_og_title' => $request->seo_og_title ?? null,
            'seo_og_description' => $request->seo_og_description ?? null,
        ])->tags()->attach($request->tag_id);

        Blog::deleteOrphanImages();

        session()->flash('success', "Blog was created Successfully!");
        return redirect(route('blogs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);
        $tags = Tag::all();
        return view("admin.blogs.edit", compact([
            'blog',
            'tags',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $this->authorize('update', $blog);
        if(!Storage::exists('blog-detail-images/')){
            Storage::makeDirectory("blog-detail-images/");
        }
        $blogDetailOldImageNames = $blog->getAllBlogDetailImageNames();
        $data = $request->only(['title', 'excerpt', 'body', 'published_at', 'seo_description', 'seo_keywords', 'seo_og_title', 'seo_og_description']);
        if($request->hasFile('image')){
            $image = $request->image->store('blogs');
            $blog->deleteImage();
            $data['image'] = $image;
        }
        $data['approved_by'] = NULL;
        $data['approved_at'] = NULL;
        $blog->update($data);
        $blog->tags()->sync($request->tag_id);
        $blogDetailNewImageNames = $blog->getAllBlogDetailImageNames();

        foreach ($blogDetailOldImageNames as $oldImageName){
            if(!in_array($oldImageName, $blogDetailNewImageNames)){
                Storage::delete("blog-detail-images/$oldImageName");
            }
        }

        Blog::deleteOrphanImages();

        session()->flash('success', "Blog was updated Successfully");
        return redirect(route('blogs.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $blog);
        $blog->deleteImage();
        $blogDetailImageNames = $blog->getAllBlogDetailImageNames();
        foreach ($blogDetailImageNames as $imageName){
            Storage::delete("blog-detail-images/$imageName");
        }
        $blog->forceDelete();
        session()->flash('success', 'Blog was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Blog $blog){
        $this->authorize('delete', $blog);
        $blog->delete();
        session()->flash('success', 'Blog was trashed Successfully');
        return redirect(route('blogs.index'));
    }

    public function trashed(){
        $trashed = Blog::onlyTrashed()->paginate(1);
        return view('admin.blogs.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedBlog = Blog::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedBlog);
        $trashedBlog->restore();
        session()->flash('success', 'Blog was restored Successfully!');
        return redirect(route('blogs.index'));
    }
}
