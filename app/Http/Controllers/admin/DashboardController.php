<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Enquiry;
use App\FRE;
use App\Http\Controllers\Controller;
use App\Property;
use App\Testimonial;
use App\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        // The dashboard lists customer enquiries and visitor logs, so it is
        // for admins only. Authors go straight to their blog posts.
        $user = auth()->user();
        if (!($user->isAdmin() || $user->isSuperAdmin())) {
            return redirect()->route('blogs.index');
        }

        $property_count = Property::withoutTrashed()->count();
        $fre_count = FRE::withoutTrashed()->count();
        $blog_count = Blog::withoutTrashed()->approved()->count();
        $testimonial_count = Testimonial::withoutTrashed()->count();
        $enquiry_count = Enquiry::withoutTrashed()->count();
        $visit_count = Visit::withoutTrashed()->count();
        $visits = Visit::withoutTrashed()->latest('created_at')->limit(5)->get();
        $enquiries = Enquiry::withoutTrashed()->latest('created_at')->limit(5)->get();

        return view('admin.dashboard', compact([
            'property_count',
            'fre_count',
            'blog_count',
            'testimonial_count',
            'enquiry_count',
            'visit_count',
            'visits',
            'enquiries',
        ]));
    }
}
