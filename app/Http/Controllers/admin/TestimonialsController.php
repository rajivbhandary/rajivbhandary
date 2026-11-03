<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonials\CreateTestimonialRequest;
use App\Http\Requests\Testimonials\UpdateTestimonialRequest;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class TestimonialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Testimonial::class);
        return view('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Testimonial::class);
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTestimonialRequest $request)
    {
        $this->authorize('create', Testimonial::class);

        if(!Storage::exists('testimonial-detail-images/')){
            Storage::makeDirectory("testimonial-detail-images/");
        }
        $image = $request->file('image')->store('testimonials');
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'city' => $request->city,
            'testimonial' => $request->testimonial,
            'image' => $image,
        ]);

        Testimonial::deleteOrphanImages();

        session()->flash('success', "Testimonial was created Successfully!");
        return redirect(route('testimonials.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);
        return view('admin.testimonials.edit', compact([
            'testimonial',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $this->authorize('update', $testimonial);
        if(!Storage::exists('testimonial-detail-images/')){
            Storage::makeDirectory("testimonial-detail-images/");
        }
        $testimonialDetailOldImageNames = $testimonial->getAllTestimonialDetailImageNames();
        $data = $request->only(['name', 'designation', 'city', 'testimonial']);
        if($request->hasFile('image')){
            $image = $request->image->store('testimonials');
            $testimonial->deleteImage();
            $data['image'] = $image;
        }
        $testimonial->update($data);
        $testimonialDetailNewImageNames = $testimonial->getAllTestimonialDetailImageNames();

        foreach ($testimonialDetailOldImageNames as $oldImageName){
            if(!in_array($oldImageName, $testimonialDetailNewImageNames)){
                Storage::delete("testimonial-detail-images/$oldImageName");
            }
        }

        Testimonial::deleteOrphanImages();

        session()->flash('success', "Testimonial was updated Successfully");
        return redirect(route('testimonials.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $testimonial);
        $testimonial->deleteImage();
        $testimonial->forceDelete();
        session()->flash('success', 'Testimonial was deleted Successfully!');
        return redirect()->back();
    }
    public function trash(Testimonial $testimonial){
        $this->authorize('delete', $testimonial);
        $testimonial->delete();
        session()->flash('success', 'Testimonial was trashed Successfully');
        return redirect(route('testimonials.index'));
    }

    public function trashed(){
        $trashed = Testimonial::onlyTrashed()->paginate(10);
        return view('admin.testimonials.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedTestimonial = Testimonial::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedTestimonial);
        $trashedTestimonial->restore();
        session()->flash('success', 'Testimonial was restored Successfully!');
        return redirect(route('testimonials.index'));
    }
}
