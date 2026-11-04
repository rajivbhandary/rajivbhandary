<?php

namespace App\Http\Controllers\frontend;

use App\Config;
use App\FRE;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Support\Facades\Request;

class FREController extends Controller
{
    public function index()
    {
        $fres = FRE::withoutTrashed()->with(['location', 'developer'])->latest()->paginate(10);
        $fre_count = $fres->total();
        $page_seo = Page::where('route_name', 'frontend.fre')->first();

        return view('frontend.fre-list', compact('fres', 'page_seo', 'fre_count'));
    }

    public function show(FRE $fre)
    {
        $fre->load(['location', 'developer', 'image.image']);
        $latest_fre = FRE::withoutTrashed()->with('location')->latest('created_at')->where('id', '!=', $fre->id)->limit(3)->get();

        return view('frontend.single-fre', compact('fre', 'latest_fre'));
    }
}
