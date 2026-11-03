<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FRE extends Model
{
    use SoftDeletes;

    protected $table = "fre";

    protected $fillable = [
        'title',
        'slug',
        'overview',
        'commercial_space',
        'possesion_date',
        'rera_number',
        'total_price',
        'minimum_investment',
        'rental_yield',
        'gross_yield',
        'expected_irr',
        'target_multiplier',
        'feature_image_path',
        'details_info',
        'floor_plate',
        'floor',
        'car_parking',
        'elevators',
        'built_up_area',
        'carpet_area',
        'property_type',
        'tenant_overview',
        'founded',
        'industry',
        'market_cap',
        'employees',
        'website',
        'additional_info',
        'seo_description',
        'seo_keywords',
        'seo_og_title',
        'seo_og_description',
        'location_id',
        'developer_id',
    ];

    public function location() {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function developer() {
        return $this->hasOne(Developer::class, 'id');
    }

    public function image(){
        return $this->hasMany(ImageFRE::class);
    }

    public function overviewKeypoints(){
        return $this->hasMany(FREOverviewKeypoint::class);
    }

    public function amenity(){
        return $this->hasMany(FREAmenity::class);
    }

    public function surroundings(){
        return $this->hasMany(FRESurrounding::class);
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'model', 'model');
    }

    /**
     * Hepler Method
     */
    /*
     * The below method will give all the image names present in the 'storage/fre-freid/' directory
     */
    // public static function moveAllUploadedFREImages($folderName, $freID){
    //     $baseURL = "fres/$freID";

    //     Storage::makeDirectory($baseURL);
    //     $imagesInFolder = File::files("storage/fres-temp/$folderName");
    //     foreach($imagesInFolder as $tempImage){
    //         $image = pathinfo($tempImage);
    //         $imageName = $image['basename'];
    //         Storage::move("fres-temp/$folderName/$imageName", "fres/$freID/$imageName");
    //     }
        
    //     $allImagesInFolder = File::files("storage/fres/$freID");
    //     // dd($allImagesInFolder);

    //     return $allImagesInFolder;
    // }

    public function getUploadedImages(){
        $imageFre = $this->image;
        $imagePath = "";
        foreach($imageFre as $temp)
        {
            $imagePath .= url("/")."/storage/".$temp->image->path . "|";
        }
        return $imagePath;
    }

    public function manageImages($request){
        if($request->has('removeImages')){
            $removeImages = $request->get('removeImages');
            foreach($removeImages as $image){
                Image::where('path', '=', $image)->forceDelete();
                Storage::delete($image);
            }
        }

        if($request->has('uploadImages')){
            $uploadImages = $request->get('uploadImages');
            foreach($uploadImages as $newImage)
            {
                if($newImage != "undefined")
                {
                    $image = Image::create([
                        'path' => $newImage
                    ]);

                    $imageFre = ImageFre::create([
                        'image_id' => $image->id,
                        'f_r_e_id' => $this->id
                    ]);
                }
            }
        }
    }

    public function getAllUploadedFREImageNames(){
        $imagesInFolder = File::files("storage/fres/$this->id/");
        $allImageNames = array();
        foreach($imagesInFolder as $path) {
            $image = pathinfo($path);
            $allImageNames[] = $image["basename"];
        }
        return $allImageNames;
    }

    public function deleteOrphanImages(){
        $existingImages = File::allFiles("storage/fres/".$this->id);
        $requiredImages = array();
        $fres = FRE::all();
        foreach ($fres as $fre){
            $requiredImages = array_merge($requiredImages, $fre->getAllUploadedFREImageNames());
        }
        foreach ($existingImages as $image){
            $imageName = $image->getBasename();
            if(!in_array($imageName, $requiredImages)){
                Storage::delete("fres/$this->id/$imageName");
            }
        }
    }

    public static function getAllUploadedFREImagesConcated($freID){
        $imagesInFolder = File::files("storage/fres/$freID");
        $allImageNames = "";
        foreach($imagesInFolder as $path) {
            $image = pathinfo($path);
            // dd($path->getLinkTarget());
            $allImageNames .= url("/")."/{$image['dirname']}/{$image['basename']}|";
            // $allImageNames .= "{$path->getLinkTarget()}|";
        }
        return $allImageNames;
    }

    public function deleteImage()
    {
        Storage::delete($this->feature_image_path);
    }

    /**
     * ACCESSORS
     */
    public function getAddressAttribute()
    {
        $address = "";
        $location = $this->location;
        $address .= "$location->building_name, $location->street, $location->landmark, $location->locality, $location->town, $location->city - $location->pincode $location->state, $location->country";

        return $address;
    }
    
    /**
     * SCOPE Querires
     */
    public function scopeJoinTables($query){
        return $query->join('locations AS fre_locations', 'fre.location_id', '=', 'fre_locations.id')
                ->join('developers as fre_developer', 'developer_id', '=', 'fre_developer.id')
                        ->select('fre.*', DB::raw("CONCAT(fre_locations.building_name, ', ', fre_locations.street, ', ', IFNULL(fre_locations.landmark, ''), ', ', fre_locations.locality, ', ', fre_locations.town, ', ', fre_locations.city, ' - ', fre_locations.pincode, ', ', fre_locations.state, ', ', fre_locations.country) AS fre_address"));
    }

    public function scopeFilter($query)
    {
        if(!(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())){
            return $query->where('user_id', auth()->user()->id);
        }
        return $query;
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where('title', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.building_name', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.street', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.landmark', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.locality', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.town', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.city', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.pincode', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.state', 'like', "%{$searchValue}%")
                ->orWhere('fre_locations.country', 'like', "%{$searchValue}%")
                ->orWhere('total_price', 'like', "%{$searchValue}%")
                ->orWhere('fre_developer.name', 'like', "%{$searchValue}%")
                ->orWhere('possesion_date', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "title", "address", "fre_developer.name", "fre.total_price", "fre.possesion_date", "actions"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
            // dd($query->getSql());
        }
        return $query;
    }

    public function scopeLimitBy($query, $start, $length)
    {
        if ($length != -1) {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }

    public function scopeSearchTitle($query, $search)
    {
        if($search){
            return $query->where('title', 'LIKE', "%$search%");
        }else{
            return $query;
        }
    }

    public function scopeFreOfCurrentYear($query)
    {
        // return $query->
        return DB::select("SELECT COUNT(*) AS count, DATE_FORMAT(created_at, '%y') as year, DATE_FORMAT(created_at, '%m') as month FROM fre WHERE year(created_at) = year(CURDATE()) GROUP BY month(created_at)");
    }
}
