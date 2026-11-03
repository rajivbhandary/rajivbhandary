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
        $fres = FRE::withoutTrashed()->latest()->paginate(10);
        $fre_count = FRE::withoutTrashed()->searchTitle(request('search'))->count();
        $config = Config::first();
        $page_seo = Page::where('route_name', Request::route()->getName())->first();
        
        return view('frontend.fre-list', compact([
            'fres',
            'page_seo',
            'config',
            'fre_count',
        ]));
    }

    public function show(FRE $fre)
    {
        // dd($fre);
        $latest_fre = FRE::withoutTrashed()->latest('created_at')->where('id', '!=',$fre->id)->limit(3)->get();
        $freIds = FRE::withoutTrashed()->get()->pluck('id')->toArray();
        $config = Config::first();
        return view('frontend.single-fre', compact([
            'fre',
            'latest_fre',
            'config',
        ]));
    }
}
