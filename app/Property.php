<?php

namespace App;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Property extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'location_id',
        'status', 
        'type',
        'detailed_type',
        'rent_detail_id',
        'number_of_bathrooms',
        'total_floors',
        'floor_number',
        'age_of_property',
        'carpet',
        'built_up',
        'super_built_up',
        'rera_number',
        'price',
        'negotiable',
        'under_construction',
        'owner_name',
        'owner_email',
        'owner_phone_number',
        'slug',
        'available_by',
        'description',
        'feature_image_path',
        'additional_info',
    ];

    //CONSTANTS
    /**
     * RELATIONSHIP FUNCTIONS
     */
    public function rentDetail() {
        return $this->hasOne(RentDetail::class, 'id');
    }

    public function location() {
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

    public function image() {
       return $this->hasMany(ImageProperty::class);
    } 

    public function amenity() {
       return $this->hasMany(PropertyAmenity::class);
    }

    public function facility() {
        return $this->hasMany(PropertyFacility::class);
    }

    public function surrounding() {
        return $this->hasMany(PropertySurrounding::class);
    }

    public function safetyEquipment() {
        return $this->hasMany(PropertySafetyEquipment::class);
    }

    public function specialRoom() {
        return $this->hasMany(PropertySpecialRoom::class);
    }

    public function residential() {
        return $this->hasOne(Residential::class);
    }

    public function office() {
        return $this->hasOne(Office::class);
    }

    public function shop() {
        return $this->hasOne(Shop::class);
    }

    public function land(){
        return $this->hasOne(Land::class);
    }

    public function otherCommercial() {
        return $this->hasOne(OtherCommercial::class);
    }

    public function enquiries()
    {
        return $this->morphMany(Enquiry::class, 'model', 'model');
    }

    /**
     * Hepler Method
     */

    // public static function getAllImageNames($path){
    //     $allImages = File::files($path);
    //     $allImageNames = array();
    //     foreach($allImages as $path) {
    //         $image = pathinfo($path);
    //         $allImageNames[] = $image["basename"];
    //     }
    //     return $allImageNames;
    // }

    public function getAllUploadedPropertyImagePath(){
        $imagesInFolder = File::files("storage/properties");
        return $imagesInFolder;
    }

    public function getAllUploadedPropertyImageNames(){
        $imagesInFolder = File::files("storage/properties");
        $allImageNames = array();
        foreach($imagesInFolder as $path) {
            $image = pathinfo($path);
            $allImageNames[] = $image["basename"];
        }
        return $allImageNames;
    }

    public function getUploadedImages(){
        $imageProperty = $this->image;
        $imagePath = "";
        foreach($imageProperty as $temp)
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

                    $imageProperty = ImageProperty::create([
                        'image_id' => $image->id,
                        'property_id' => $this->id
                    ]);
                }
            }
        }
    }

    public function deleteImage()
    {
        Storage::delete($this->feature_image_path);
    }

    public function isRent()
    {
        return $this->status == 'Rent';
    }

    public function isSell()
    {
        return $this->status == 'Sell';
    }

    public function isResidential()
    {
        return $this->type == 'Residential';
    }

    public function isCommercial()
    {
        return $this->type == 'Commercial';
    }

    public function isOffice()
    {
        return Office::where('property_id', '=', $this->id)->first() == null ? false : true;
    }

    public function isShop()
    {
        return Shop::where('property_id', '=', $this->id)->first() == null ? false : true;
    }
    
    public function isLand()
    {
        return Land::where('property_id', '=', $this->id)->first() == null ? false : true;
    }

    public function isOtherCommercial()
    {
        return OtherCommercial::where('property_id', '=', $this->id)->first() == null ? false : true;
    }

    public function getCommercialType()
    {
        return $this->isOffice() ? 'Offices' : ($this->isShop() ? 'Shops' : ($this->isLand() ? 'Land' : ($this->isOtherCommercial() ? 'Others': false)));
    }

    public function getRentDetails()
    {
        return RentDetail::findOrFail($this->rent_detail_id);
    }

    public function getLocationDetails()
    {
        return Location::findOrFail($this->location_id);
    }

    public function getResidential()
    {
        return Residential::where('property_id', '=', $this->id)->first();
    }

    public function getOffice()
    {
        return Office::where('property_id', '=', $this->id)->first();
    }

    public function getShop()
    {
        return Shop::where('property_id', '=', $this->id)->first();
    }

    public function getOtherCommercials()
    {
        return OtherCommercial::where('property_id', '=', $this->id)->first();
    }

    public function getAmenities()
    {
        return PropertyAmenity::where('property_id', '=', $this->id)->get();
    }

    public function getFacilities()
    {
        return PropertyFacility::where('property_id', '=', $this->id)->get();
    }

    public function getSurroundings()
    {
        return PropertySurrounding::where('property_id', '=', $this->id)->get();
    }

    public function getSafetyEquipments()
    {
        return PropertySafetyEquipment::where('property_id', '=', $this->id)->get();
    }

    public function getSpecialRooms()
    {
        return PropertySpecialRoom::where('property_id', '=', $this->id)->get();
    }

    public function getsuitableBusiness()
    {
        return PropertySuitableBusiness::where('property_id', '=', $this->id)->get();
    }

    /**
     * ACCESSORS
     */
    public function getAddressAttribute()
    {
        $address = "";
        $location = $this->location;
        if($this->isResidential())
        {
            $address .= $this->residential->house_no;
        }
        else if($this->isOffice())
        {
            $address .= $this->office->office_no;
        }
        else if($this->isShop())
        {
            $address .= $this->shop->shop_no;
        }
        else if($this->isOtherCommercial())
        {
            $address .= $this->otherCommercial->office_no;
        }
        $address .= ", $location->building_name, $location->street, $location->landmark, $location->locality, $location->town, $location->city - $location->pincode $location->state, $location->country";

        return $address;
    }

    /**
     * SCOPE QUERIES
     */

    public function scopeJoinTables($query){
        return $query->leftJoin('locations AS property_locations', 'properties.location_id', '=', 'property_locations.id')
                        ->select('properties.*', DB::raw("CONCAT(property_locations.building_name, ', ', property_locations.street, ', ', IFNULL(property_locations.landmark, ''), ', ', property_locations.locality, ', ', property_locations.town, ', ', property_locations.city, ' - ', property_locations.pincode, ', ', property_locations.state, ', ', property_locations.country) AS `property_address`"));
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
            return $query->where('status', 'like', "%{$searchValue}%")
                    ->orWhere('type', 'like', "%{$searchValue}%")
                    ->orWhere('age_of_property', 'like', "%{$searchValue}%")
                    ->orWhere('carpet', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.building_name', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.street', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.landmark', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.locality', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.town', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.city', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.pincode', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.state', 'like', "%{$searchValue}%")
                    ->orWhere('property_locations.country', 'like', "%{$searchValue}%")
                    ->orWhere('owner_name', 'like', "%{$searchValue}%")
                    ->orWhere('under_construction', 'like', "%{$searchValue}%");
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "feature_image_path", "status", "type", "owner_name", "carpet", 'address', "under_construction", "age_of_property", "actions"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
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

    public function scopeAdvanceSearch($query, $searchValue){
        // town search
        // normal search
        if(isset($searchValue['status'])){
            if($searchValue['status'] == 'for-buy'){
                $query->where('properties.status', '=', 'Sell');
                if(isset($searchValue->min_price)){
                    if($searchValue->max_price == 200000000){
                        $query->where('properties.price', '>=', $searchValue->min_price);
                    }else{
                        $query->whereBetween('properties.price', [$searchValue->min_price, $searchValue->max_price]);
                    }
                }
            }else if($searchValue['status'] == 'for-rent'){
                $query->join('rent_details', function($join){
                    $join->on('properties.rent_detail_id', '=', 'rent_details.id')
                        ->where('properties.status', '=', 'Rent');
                });
                if(isset($searchValue->min_price)){
                    if($searchValue->max_price == 200000000){
                        $query->where('rent_details.amount', '>=', $searchValue->min_price);
                    }else{
                        $query->whereBetween('rent_details.amount', [$searchValue->min_price, $searchValue->max_price]);
                    }
                }
            }
        }
        $query->leftJoin('locations AS property_locations', 'properties.location_id', '=', 'property_locations.id');
        if(isset($searchValue->search)){
            $query->where('property_locations.building_name', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.street', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.landmark', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.locality', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.town', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.city', 'like', "%{$searchValue->search}%")
            ->orWhere('property_locations.pincode', 'like', "%{$searchValue->search}%");
        }
        
        if($searchValue['location-town'] != null){
            $query->where('property_locations.town', 'like', "%{$searchValue['location-town']}%");
        }
        

        if(isset($searchValue->min_sqrt)){
            if($searchValue->max_sqrt == 4000){
                $query->where('properties.carpet', '>=', $searchValue->min_sqrt);
            }else{
                $query->whereBetween('properties.carpet', [$searchValue->min_sqrt, $searchValue->max_sqrt]);
            }
        }
        

        if(isset($searchValue['property-type'])){
            if($searchValue['property-type'] == '1'){
                $query->where('properties.type', '=', "Residential");
                $query->join('residentials', function($join){
                    $join->on('properties.id', '=', 'residentials.property_id');
                });
                if($searchValue['property-bedrooms'] != null){
                    $query->where('residentials.number_of_bedrooms', '=', $searchValue['property-bedrooms']);
                }
            }else if($searchValue['property-type'] == '2'){  
                $query->where('properties.type', '=', "Commercial");
                if(isset($searchValue['property-subtype'])){
                    if($searchValue['property-subtype'] == 1){
                        $query->join('offices', function($join){
                            $join->on('properties.id', '=', 'offices.property_id');
                        });
                    }

                    else if($searchValue['property-subtype'] == 2){
                        $query->join('shops', function($join){
                            $join->on('properties.id', '=', 'shops.property_id');
                        });
                    }

                    else if($searchValue['property-subtype'] == 3){
                        $query->join('other_commercials', function($join){
                            $join->on('properties.id', '=', 'other_commercials.property_id');
                        });
                    }
                }
            }
        }
        
        $query->select('properties.*');
        
        return $query;
    }
    
    public function scopeRentProperty($query)
    {
        return $query->where('status', '=', 'Rent');
    }

    public function scopeSellProperty($query)
    {
        return $query->where('status', '=', 'Sell');
    }

    public function scopeResidentialProperty($query)
    {
        return $query->where('type', '=', 'Residential');
    }

    public function scopeCommercialProperty($query)
    {
        return $query->where('type', '=', 'Commercial');
    }

    public function scopePropertyOfCurrentYear($query)
    {
        // return $query->
        return DB::select("SELECT COUNT(*) AS count, DATE_FORMAT(created_at, '%y') as year, DATE_FORMAT(created_at, '%m') as month FROM properties WHERE year(created_at) = year(CURDATE()) GROUP BY month(created_at)");
    }
}
