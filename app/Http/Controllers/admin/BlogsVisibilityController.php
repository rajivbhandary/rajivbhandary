<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Http\Controllers\Controller;
use App\Notifications\BlogVisibilityNotification;
use Illuminate\Http\Request;

class BlogsVisibilityController extends Controller
{
    public function approve(Blog $blog) {
        $this->authorize('approve', $blog);
        $data['approved_by'] = auth()->user()->id;
        $data['approved_at'] = now();
        $blog->update($data);
        $blog->author->notify(new BlogVisibilityNotification($blog));
        session()->flash('success', "Blog was approved Successfully");
        return redirect(route('blogs.index'));
    }

    public function disapprove(Blog $blog) {
        $this->authorize('disapprove', $blog);
        $data['approved_by'] = NULL;
        $data['approved_at'] = NULL;
        $blog->update($data);
        $blog->author->notify(new BlogVisibilityNotification($blog));
        session()->flash('success', "Blog was disapproved Successfully");
        return redirect(route('blogs.index'));
    }
}
