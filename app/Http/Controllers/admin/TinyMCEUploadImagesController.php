<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Image uploads from the TinyMCE rich-text editor.
 */
class TinyMCEUploadImagesController extends Controller
{
    public function uploadBlogImage(Request $request)
    {
        return $this->store($request, 'blog-detail-images');
    }

    public function uploadTestimonialImage(Request $request)
    {
        return $this->store($request, 'testimonial-detail-images');
    }

    private function store(Request $request, $directory)
    {
        $request->validate(['file' => ImageUploadController::IMAGE_RULES]);

        $image = $request->file('file')->store($directory);

        return response()->json(['location' => asset("storage/$image")]);
    }
}
