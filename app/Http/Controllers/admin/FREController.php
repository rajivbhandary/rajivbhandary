<?php

namespace App\Http\Controllers\admin;

use App\Developer;
use App\FRE;
use App\FREAmenity;
use App\FREOverviewKeypoint;
use App\FRESurrounding;
use App\Http\Controllers\Controller;
use App\Image;
use App\ImageFRE;
use App\Location;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Environment\Console;

class FREController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', FRE::class);
        return view('admin.fre.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', FRE::class);
        return view('admin.fre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($this->validateFRE($request), $this->validateDeveloper($request), $this->validateLocation($request));
        $this->authorize('create', FRE::class);

        if($this->validateFRE($request) && $this->validateDeveloper($request) && $this->validateLocation($request)){
            // dd($image);
            // dd("here");
            $locationID = $this->createLocation($request);
            // dd("here");
            $developerID = $this->createDeveloper($request);
            // dd("here");
            $freID = $this->createFRE($request, $locationID, $developerID);
            // dd("here");
            $this->createAmenitySurroundingOverviewKeypoint($request, $freID);
            // dd("here");

            // $this->insertUploadedFREImage($request['folder_name'], $freID);

            return 'success';
       }else{
           return 'failure';
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FRE  $fre
     * @return \Illuminate\Http\Response
     */
    public function show(FRE $fre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FRE  $fre
     * @return \Illuminate\Http\Response
     */
    public function edit(FRE $fre)
    {
        $this->authorize('update', $fre);
        return view("admin.fre.edit", compact([
            'fre',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FRE  $fre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FRE $fre)
    {
        // dd($this->validateUpdateFRE($request), $this->validateDeveloper($request), $this->validateLocation($request));
        $this->authorize('update', $fre);
        if($this->validateUpdateFRE($request) && $this->validateDeveloper($request) && $this->validateLocation($request)){
            // dd("here");
            $locationID = $this->updateLocation($fre->location_id, $request);
            $developerID = $this->updateDeveloper($fre->developer_id, $request);
            $freID = $this->updateFRE($fre, $request, $locationID, $developerID);
            $this->updateAmenitySurroundingOverviewKeypoint($request, $freID);
            // dd("here 2");
            return 'success';
        }else{
            return 'failure';
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FRE  $fre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fre = FRE::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $fre);
        $this->deleteAmenitySurroundingOverviewKeypoint($fre);
        $this->deleteImages($fre);
        Storage::delete($fre->feature_image_path);

        $imageFre = $fre->image;
        foreach($imageFre as $temp)
        {
            Image::where('path', '=', $temp->image['path'])->forceDelete();
            Storage::delete($temp->image['path']);
        }

        $fre->forceDelete();
        session()->flash('success', 'FRE was deleted Successfully');
        return redirect(route('fre.trashed'));
    }

    public function trash(FRE $fre){
        $this->authorize('delete', $fre);
        $fre->delete();
        session()->flash('success', 'FRE was trashed Successfully');
        return redirect(route('fre.index'));
    }

    public function trashed(){
        $trashed = FRE::onlyTrashed()->paginate(1);
        return view('admin.fre.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedFRE = FRE::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedFRE);
        $trashedFRE->restore();
        session()->flash('success', 'FRE was restored Successfully!');
        return redirect(route('fre.index'));
    }

    private function createLocation($request){
        $location = Location::create([
            'building_name' => $request->location_building_name,
            'street' => $request->location_street,
            'landmark' => $request->location_landmark ?? null,
            'locality' => $request->location_locality,
            'town' => $request->location_town,
            'city' => $request->location_city,
            'pincode' => $request->location_pincode,
            'state' => $request->location_state,
            'country' => $request->location_country,
            'latitude' => $request->location_latitude,
            'longitude' => $request->location_longitude,
        ]);

        return $location->id;
    }

    private function createDeveloper($request){
        $developerID = Developer::create([
            'name' => $request->developer_name,
            'rera_number' => $request->developer_rera_number ?? null,
            'info' => $request->developer_overview,
        ]);

        return $developerID->id;
    }

    private function createFRE($request, $locationID, $developerID){
        $image = $request->file('fre_feature_image')->store('fres-feature-image');
        $fre = FRE::create([
            'location_id' => $locationID,
            'developer_id' => $developerID,
            'title' => $request->title,
            'slug' => Str::slug(lcfirst($request->title)),
            'overview' => $request->overview,
            'commercial_space' => $request->commercial_space,
            'possesion_date' => $request->fre_availability_by,
            'rera_number' => $request->fre_rera_number,
            'total_price' => $request->total_price,
            'minimum_investment' => $request->minimum_investment,
            'rental_yield' => $request->rental_yield ?? null, 
            'gross_yield' => $request->gross_yield ?? null,
            'expected_irr' => $request->expected_irr ?? null,
            'target_multiplier' => $request->target_multiplier ?? null,
            'details_info' => $request->details_info ?? null,
            'floor_palte' => $request->floor_plate ?? null,
            'floor' => $request->floor ?? null,
            'feature_image_path' => $image,
            'car_parking' => $request->car_parking ?? null,
            'elevators' => $request->elevators ?? null,
            'built_up_area' => $request->built_up_area ?? null,
            'carpet_area' => $request->carpet_area ?? null,
            'property_type' => $request->property_type ?? null,
            'tenant_overview' => $request->tenant_overview,
            'founded' => $request->founded ?? null,
            'industry' => $request->industry ?? null, 
            'market_cap' => $request->market_cap ?? null,
            'employees' => $request->employees ?? null,
            'website' => $request->website ?? null, 
            'seo_description' => $request->seo_description ?? null,
            'seo_keywords' => $request->seo_keywords ?? null,
            'seo_og_title' => $request->seo_og_title ?? null,
            'seo_og_description' => $request->seo_og_description ?? null,
        ]);
        $fre->manageImages($request);
        // dd("here");
        return $fre->id;
    }

    private function createAmenitySurroundingOverviewKeypoint($request, $freID){

        // dd($request->overview_keypoint_name[0]);
        if($request->overview_keypoint_name[0] != null){
            foreach($request->overview_keypoint_name as $overview_keypoint_name){
                if($overview_keypoint_name != null){
                    FREOverviewKeypoint::create([
                        'name' => $overview_keypoint_name,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }

        if($request->amenity_name[0] != null){
            foreach($request->amenity_name as $amenity){
                if($amenity != null){
                    FREAmenity::create([
                        'name' => $amenity,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }

        if($request->surrounding_name[0] != null){
            foreach($request->surrounding_name as $surrounding){
                if($surrounding != null){
                    FRESurrounding::create([
                        'name' => $surrounding,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }
    }

    private function deleteAmenitySurroundingOverviewKeypoint($fre){
        foreach($fre->amenity as $amenity){
            $amenity->forceDelete();
        }

        foreach($fre->surroundings as $surrounding){
            $surrounding->forceDelete();
        }

        foreach($fre->overviewKeypoints as $overviewkeypoint){
            $overviewkeypoint->forceDelete();
        }

    }

    private function validateFRE($request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'overview' => 'required|min:2',
            'commercial_space' => 'required|max:255',
            'total_price' => 'required|numeric',
            'minimum_investment' => 'required|max:255',
            'rental_yield' => 'numeric|nullable',
            'gross_yield' => 'numeric|nullable',
            'expected_irr' => 'numeric|nullable',
            'target_multiplier' => 'numeric|nullable',
            'fre_rera_number' => 'required|max:12',
            'details_info' => 'required|min:10|max:255',
            'floor_plate' => 'numeric|nullable',
            'floor' => 'numeric|nullable',
            'car_parking' => 'numeric|nullable',
            'elevators' => 'numeric|nullable',
            'built_up_area' => 'required|numeric',
            'carpet_area' => 'required|numeric',
            'property_type' => 'max:255',
            'tenant_overview' => 'required|min:10|max:2000',
            'fre_feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'founded' => "max:". date('Y') . "|nullable",
            'industry' => 'max:255|nullable',
            'market_cap' => 'max:255|nullable',
            'employees' => 'numeric|nullable',
            'tenant_overview' => 'required',
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:2000',
            'seo_og_title' => 'max:255',
            'seo_og_description' => 'max:255',
        ]);

        // dd($validator->errors());

        return (!$validator->fails());
    }

    private function validateUpdateFRE($request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'overview' => 'required|min:2',
            'commercial_space' => 'required|max:255',
            'total_price' => 'required|numeric',
            'minimum_investment' => 'required|max:255',
            'rental_yield' => 'numeric|nullable',
            'gross_yield' => 'numeric|nullable',
            'expected_irr' => 'numeric|nullable',
            'target_multiplier' => 'numeric|nullable',
            'fre_rera_number' => 'required|max:12',
            'details_info' => 'required|min:10|max:255',
            'floor_plate' => 'numeric|nullable',
            'floor' => 'numeric|nullable',
            'car_parking' => 'numeric|nullable',
            'elevators' => 'numeric|nullable',
            'built_up_area' => 'required|numeric',
            'carpet_area' => 'required|numeric',
            'property_type' => 'max:255',
            'tenant_overview' => 'required|min:10|max:2000',
            'fre_feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'founded' => "max:". date('Y') . "|nullable",
            'industry' => 'max:255|nullable',
            'market_cap' => 'max:255|nullable',
            'employees' => 'numeric|nullable',
            'tenant_overview' => 'required',
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:2000',
            'seo_og_title' => 'max:255',
            'seo_og_description' => 'max:255',
        ]);

        // dd($validator->errors());

        return (!$validator->fails());

    }

    private function validateDeveloper($request){

        $validator = Validator::make($request->all(), [
            'developer_name' => 'required',
            'developer_rera_number' => 'max:12',
            'developer_overview' => 'required|min:10|max:255',
        ]);

        return (!$validator->fails());
        
    }

    private function validateLocation($request){
        $validator = Validator::make($request->all(), [
            'location_building_name' => 'required|min:2|max:255',
            'location_street' => 'required|min:2|max:255',
            'location_locality' => 'required|min:2|max:255',
            'location_landmark' => 'max:255',
            'location_town' => 'required|min:2|max:255',
            'location_city' => 'required|min:2|max:255',
            'location_pincode' => 'required|min:6|max:6',
            'location_state' => 'required|min:2|max:255',
            'location_country' => 'required',
            'location_latitude' => 'required',
            'location_longitude' => 'required',
        ]);

        // dd($validator->errors());
        return (!$validator->fails());
    }

    private function deleteImages(FRE $fre){
        foreach($fre->image as $image){
            $img = Image::find($image->image_id);
            Storage::delete($img->path);
            $image->forceDelete();
            $img->forceDelete();
        }
    }

    /**************************************** UPDATE TABLES ****************************************/
    private function updateLocation($locationID, $request){
        $location = Location::findOrFail($locationID);

        $location->update([
            'building_name' => $request->location_building_name,
            'street' => $request->location_street,
            'landmark' => $request->location_landmark ?? null,
            'locality' => $request->location_locality,
            'town' => $request->location_town,
            'city' => $request->location_city,
            'pincode' => $request->location_pincode,
            'state' => $request->location_state,
            'country' => $request->location_country,
            'latitude' => $request->location_latitude,
            'longitude' => $request->location_longitude,
        ]);

        return $location->id;
    }

    private function updateDeveloper($developerID, $request){
        $developer = Developer::findOrFail($developerID);

        $developer->update([
            'name' => $request->developer_name,
            'rera_number' => $request->developer_rera_number ?? null,
            'info' => $request->developer_overview,
        ]);

        return $developer->id;
    }

    private function updateFRE($fre, $request, $locationID, $developerID){
        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store("fre_feature_image");
            $fre->deleteImage();
        }
        $fre->update([
            'location_id' => $locationID,
            'developer_id' => $developerID,
            'title' => $request->title,
            'slug' => Str::slug(lcfirst($request->title)),
            'overview' => $request->overview,
            'commercial_space' => $request->commercial_space,
            'possesion_date' => $request->fre_availability_by,
            'rera_number' => $request->fre_rera_number,
            'total_price' => $request->total_price,
            'minimum_investment' => $request->minimum_investment,
            'rental_yield' => $request->rental_yield ?? null, 
            'gross_yield' => $request->gross_yield ?? null,
            'expected_irr' => $request->expected_irr ?? null,
            'target_multiplier' => $request->target_multiplier ?? null,
            'details_info' => $request->details_info ?? null,
            'floor_palte' => $request->floor_plate ?? null,
            'floor' => $request->floor ?? null,
            'car_parking' => $request->car_parking ?? null,
            'elevators' => $request->elevators ?? null,
            'built_up_area' => $request->built_up_area ?? null,
            'carpet_area' => $request->carpet_area ?? null,
            'property_type' => $request->property_type ?? null,
            'tenant_overview' => $request->tenant_overview,
            'feature_image_path' => $image != null ? $image : $fre->feature_image_path,
            'founded' => $request->founded ?? null,
            'industry' => $request->industry ?? null, 
            'market_cap' => $request->market_cap ?? null,
            'employees' => $request->employees ?? null,
            'website' => $request->website ?? null, 
            'seo_description' => $request->seo_description ?? null,
            'seo_keywords' => $request->seo_keywords ?? null,
            'seo_og_title' => $request->seo_og_title ?? null,
            'seo_og_description' => $request->seo_og_description ?? null,
        ]);

        $fre->manageImages($request);
        // dd("done");

        return $fre->id;
    }

    private function updateAmenitySurroundingOverviewKeypoint($request, $freID){

        FREOverviewKeypoint::where('f_r_e_id', '=', $freID)->forceDelete();
        FREAmenity::where('f_r_e_id', '=', $freID)->forceDelete();
        FRESurrounding::where('f_r_e_id', '=', $freID)->forceDelete();

        if($request->overview_keypoint_name[0] != null){
            foreach($request->overview_keypoint_name as $overview_keypoint_name){
                if($overview_keypoint_name != null){
                    FREOverviewKeypoint::create([
                        'name' => $overview_keypoint_name,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }

        if($request->amenity_name[0] != null){
            foreach($request->amenity_name as $amenity){
                if($amenity != null){
                    FREAmenity::create([
                        'name' => $amenity,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }

        if($request->surrounding_name[0] != null){
            foreach($request->surrounding_name as $surrounding){
                if($surrounding != null){
                    FRESurrounding::create([
                        'name' => $surrounding,
                        'f_r_e_id' => $freID,
                    ]);
                }
            }
        }
    }

}
