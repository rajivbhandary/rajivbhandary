<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        return view('admin.tags.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
        $this->authorize('create', Tag::class);
        Tag::create([
            'name' => $request->name,
        ]);

        session()->flash('success', "Tag was created Successfully!");
        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('admin.tags.edit', compact([
            'tag'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $data = $request->only(['name']);
        $tag->update($data);

        session()->flash('success', "Tag was updated Successfully");
        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $tag);
        $tag->forceDelete();
        session()->flash('success', 'Tag was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Tag $tag){
        $this->authorize('delete', $tag);
        $tag->delete();
        session()->flash('success', 'Tag was trashed Successfully');
        return redirect(route('tags.index'));
    }

    public function trashed(){
        $trashed = Tag::onlyTrashed()->paginate(10);
        return view('admin.tags.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedTag = Tag::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedTag);
        $trashedTag->restore();
        session()->flash('success', 'Tag was restored Successfully!');
        return redirect(route('tags.index'));
    }
}
