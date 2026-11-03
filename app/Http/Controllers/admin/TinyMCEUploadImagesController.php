<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyMCEUploadImagesController extends Controller
{
    public function uploadBlogImage(Request $request)
    {
        if ($request->has('file')) {
            $image = $request->file('file')->store('blog-detail-images');
            echo json_encode(array('location' => asset("storage/$image")));
        }else{
            abort(404 );
        }
    }

    public function uploadTestimonialImage(Request $request)
    {
        if ($request->has('file')) {
            $image = $request->file('file')->store('testimonial-detail-images');
            echo json_encode(array('location' => asset("storage/$image")));
        }else{
            abort(404 );
        }
    }

    public function uploadDiplomaImage(Request $request)
    {
        if ($request->has('file')) {
            $image = $request->file('file')->store('diploma-detail-images');
            echo json_encode(array('location' => asset("storage/$image")));
        }else{
            abort(404 );
        }
    }

    public function uploadCourseImage(Request $request)
    {
        if ($request->has('file')) {
            $image = $request->file('file')->store('course-detail-images');
            echo json_encode(array('location' => asset("storage/$image")));
        }else{
            abort(404 );
        }
    }
}
