<?php

namespace App\Http\Controllers\admin;

use App\Config;
use App\Http\Controllers\Controller;
use App\Http\Requests\Config\UpdateConfigRequest;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Config::class);
        $config = Config::first();
        return view('admin.config.index', compact([
            'config'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        $this->authorize('update', $config);
        return view("admin.config.edit", compact([
            'config'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigRequest $request, Config $config)
    {
        $this->authorize('update', $config);
        $data = $request->only(['default_seo_author','default_seo_description', 'default_seo_keywords', 'default_seo_og_title', 'default_seo_og_description']);
        $config->update($data);

        session()->flash('success', "Config was updated Successfully");
        return redirect(route('config.index', compact([
            'config'
        ])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
