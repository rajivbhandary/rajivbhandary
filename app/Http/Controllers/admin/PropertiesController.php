<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\ImageProperty;
use App\Land;
use App\Location;
use App\Office;
use App\OtherCommercial;
use App\Property;
use App\PropertyAmenity;
use App\PropertyFacility;
use App\PropertySafetyEquipment;
use App\PropertySpecialRoom;
use App\PropertySuitableBusiness;
use App\PropertySurrounding;
use App\RentDetail;
use App\Residential;
use App\Shop;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PropertiesController extends Controller
{

    /**
     * Display a listing of the resource.
     
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Property::class);
        return view('admin.properties.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property_status = [["id" => 1, "value" =>'Rent'],["id" => 2, "value" =>'Sell']];
        $property_types = [["id" => 1, "value" =>'Residential'],["id" => 2, "value" =>'Commercial']];
        $property_commercials = [["id" => 1, "value" =>'Offices'],["id" => 2, "value" =>'Shops'], ["id" => 3, "value" =>'Land'], ["id" => 4, "value" =>'Others']];
        $yes_no_options = [["id" => 1, "value" =>'Yes'],["id" => 2, "value" =>'No']];
        $furnished_status = [["id" => 1, "value" =>'Fully Furnished'],["id" => 2, "value" =>'Unfurnished']];
        $availability_status = [["id" => 1, "value" =>'Under Construction'],["id" => 2, "value" =>'Ready to move']];
        $security_deposite_mode = [["id" => 1, "value" =>'Fixed'],["id" => 2, "value" =>'Variable']];

        $folder_name = Carbon::now()->timestamp;
        if(!Storage::exists("properties-temp/" . $folder_name)){
            Storage::makeDirectory("properties-temp/" . $folder_name);
        }
        // dd($property_status, $property_types, $yes_no_options);

        $this->authorize('create', Property::class);
        return view('admin.properties.create', compact([
            'property_status',
            'property_types',
            'property_commercials',
            'yes_no_options',
            'furnished_status',
            'availability_status',
            'security_deposite_mode',
            'folder_name'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // dd($this->validateBasicPropertyFields($request), $this->validateOwnerDetailsFields($request), $this->validateLocationFields($request), $this->validateRentFields($request), $this->validateCommonToAllFields($request), $this->validateResidentialFields($request), $this->validateSellFields($request), $this->validateOfficeFields($request), $this->validateShopfields($request), $this->validateOtherCommercialfields($request));
    
        //Custom Validation
        if($this->validateBasicPropertyFields($request) && $this->validateOwnerDetailsFields($request) && $this->validateLocationFields($request) && $this->validateCommonToAllFields($request))
        {  
            if($request['property-type'] == 1 && $this->validateResidentialFields($request)){
                //Residential

                if($request['property-status'] == 1 && $this->validateRentFields($request)){
                    //Rent

                    $locationID = $this->createLocation($request);
                    $rentID = $this->createRentDetails($request);
                    $propertyID = $this->createProperty($request, $locationID, $rentID);
                    $this->createResidential($request, $propertyID);
                    $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);

                    return 'success';

                }else if($request['property-status'] == 2 && $this->validateSellFields($request)){
                    //Sell

                    $locationID = $this->createLocation($request);
                    $propertyID = $this->createProperty($request, $locationID, null);
                    $this->createResidential($request, $propertyID);
                    $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                    return 'success';

                }else{
                    return 'failure';
                }

            }else if($request['property-type'] == 2){
                //Commercial
                // dd('here');
            
                if($request['property-commercials'] == 1 && $this->validateOfficeFields($request)){
                    //Offices
                    // dd('offices here');
                    if($request['property-status'] == 1 && $this->validateRentFields($request)){
                        //Rent
                        // dd('offices rent here');
    
                        $locationID = $this->createLocation($request);
                        $rentID = $this->createRentDetails($request);
                        $propertyID = $this->createProperty($request, $locationID, $rentID);
                        $this->createOffice($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else if($request['property-status'] == 2 && $this->validateSellFields($request)){
                        //Sell
                        // dd('offices sell here');
    
                        $locationID = $this->createLocation($request);
                        $propertyID = $this->createProperty($request, $locationID, null);
                        $this->createOffice($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }

                }else if($request['property-commercials'] == 2 && $this->validateShopfields($request)){
                    //Shops
                    if($request['property-status'] == 1 && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->createLocation($request);
                        $rentID = $this->createRentDetails($request);
                        $propertyID = $this->createProperty($request, $locationID, $rentID);
                        $this->createShop($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else if($request['property-status'] == 2 && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->createLocation($request);
                        $propertyID = $this->createProperty($request, $locationID, null);
                        $this->createShop($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }
                }else if($request['property-commercials'] == 3){
                    //Land
                    // dd("land here");
                    if($request['property-status'] == 1 && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->createLocation($request);
                        $rentID = $this->createRentDetails($request);
                        $propertyID = $this->createProperty($request, $locationID, $rentID);
                        $this->createLand($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else if($request['property-status'] == 2 && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->createLocation($request);
                        $propertyID = $this->createProperty($request, $locationID, null);
                        $this->createLand($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }
                }else if($request['property-commercials'] == 4 && $this->validateOtherCommercialfields($request)){
                    //Other Commercials

                    if($request['property-status'] == 1 && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->createLocation($request);
                        $rentID = $this->createRentDetails($request);
                        $propertyID = $this->createProperty($request, $locationID, $rentID);
                        $this->createOtherCommercial($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else if($request['property-status'] == 2 && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->createLocation($request);
                        $propertyID = $this->createProperty($request, $locationID, null);
                        $this->createOtherCommercial($request, $propertyID);
                        $this->createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }

                }else {
                    return 'failure';
                }
            }else{
                return 'failure';
            } 
        }
        else{
            return 'failure';
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $this->authorize('update', $property);


        $property_status = [["id" => 1, "value" =>'Rent'],["id" => 2, "value" =>'Sell']];
        $property_types = [["id" => 1, "value" =>'Residential'],["id" => 2, "value" =>'Commercial']];
        $property_commercials = [["id" => 1, "value" =>'Offices'],["id" => 2, "value" =>'Shops'], ["id" => 3, "value" =>'Land'], ["id" => 4, "value" =>'Others']];
        $yes_no_options = [["id" => 1, "value" =>'Yes'],["id" => 2, "value" =>'No']];
        $furnished_status = [["id" => 1, "value" =>'Fully Furnished'],["id" => 2, "value" =>'Unfurnished']];
        $availability_status = [["id" => 1, "value" =>'Under Construction'],["id" => 2, "value" =>'Ready to move']];
        $security_deposite_mode = [["id" => 1, "value" =>'Fixed'],["id" => 2, "value" =>'Variable']];

        $folder_name = Carbon::now()->timestamp;
        if(!Storage::exists("properties-temp/" . $folder_name)){
            Storage::makeDirectory("properties-temp/" . $folder_name);
        }
        // dd(count($property->getAmenities()));

        $location = Location::findOrFail($property->location_id);
        $residential = Residential::where('property_id', '=', $property->id)->first();
        $office = Office::where('property_id', '=', $property->id)->first();
        $shop = Shop::where('property_id', '=', $property->id)->first();
        $other_commercial = OtherCommercial::where('property_id', '=', $property->id)->first();
        // dd($shop);

        return view('admin.properties.edit', compact([
            'property',
            'location',
            'residential',
            'office',
            'shop',
            'other_commercial',
            'property_status',
            'property_types',
            'property_commercials',
            'yes_no_options',
            'furnished_status',
            'availability_status',
            'security_deposite_mode',
            'folder_name'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        // dd($request['surrounding_name']);
        // dd($this->validateBasicPropertyFields($request), $this->validateOwnerDetailsFields($request), $this->validateLocationFields($request), $this->validateRentFields($request), $this->validateUpdateCommonToAllFields($request), $this->validateResidentialFields($request), $this->validateSellFields($request), $this->validateOfficeFields($request), $this->validateShopfields($request), $this->validateOtherCommercialfields($request));

        $this->authorize('update', $property);
        
        if($this->validateBasicPropertyFields($request) && $this->validateOwnerDetailsFields($request) && $this->validateLocationFields($request) && $this->validateUpdateCommonToAllFields($request))
        {  
            if($property->isResidential() && $this->validateResidentialFields($request)){
                //Residential

                if($property->isRent() && $this->validateRentFields($request)){
                    //Rent

                    $locationID = $this->updateLocation($property, $request);
                    $rentID = $this->updateRentDetails($property, $request);
                    $propertyID = $this->updateProperty($property, $request, $locationID, $rentID);
                    $this->updateResidential($request, $property);
                    $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);

                    return 'success';

                }else if($property->sell() && $this->validateSellFields($request)){
                    //Sell

                    $locationID = $this->updateLocation($property, $request);
                    $propertyID = $this->updateProperty($property, $request, $locationID, null);
                    $this->updateResidential($request, $property);
                    $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                    return 'success';

                }else{
                    return 'failure';
                }

            }else if($property->isCommercial() == 2){
                //Commercial
                // dd('here');
            
                if($property->isOffice() && $this->validateOfficeFields($request)){
                    //Offices
                    // dd('offices here');
                    if($property->isRent() && $this->validateRentFields($request)){
                        //Rent
                        // dd('offices rent here');
    
                        $locationID = $this->updateLocation($property, $request);
                        $rentID = $this->updateRentDetails($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, $rentID);
                        $this->updateOffice($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else if($property->isSell() && $this->validateSellFields($request)){
                        //Sell
                        // dd('offices sell here');
    
                        $locationID = $this->updateLocation($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, null);
                        $this->updateOffice($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }

                }else if($property->isShop() && $this->validateShopfields($request)){
                    //Shops
                    if($property->isRent() && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->updateLocation($property, $request);
                        $rentID = $this->updateRentDetails($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, $rentID);
                        $this->updateShop($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else if($property->isSell() && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->updateLocation($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, null);
                        $this->updateShop($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }

                }else if($property->isLand()){
                    //Land
                    if($property->isRent() && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->updateLocation($property, $request);
                        $rentID = $this->updateRentDetails($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, $rentID);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else if($property->isSell() && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->updateLocation($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, null);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }
                }else if($property->isOtherCommercial() && $this->validateOtherCommercialfields($request)){
                    //Other Commercials

                    if($property->isRent() && $this->validateRentFields($request)){
                        //Rent
    
                        $locationID = $this->updateLocation($property, $request);
                        $rentID = $this->updateRentDetails($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, $rentID);
                        $this->updateOtherCommercial($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else if($property->isSell() && $this->validateSellFields($request)){
                        //Sell
    
                        $locationID = $this->updateLocation($property, $request);
                        $propertyID = $this->updateProperty($property, $request, $locationID, null);
                        $this->updateOtherCommercial($request, $property);
                        $this->updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property);
                        return 'success';
    
                    }else{
                        return 'failure';
                    }

                }else {
                    return 'failure';
                }
            }else{
                return 'failure';
            } 
        }
        else{
            return 'failure';
        }  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $property = Property::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $property);
        $this->deleteAmenityFacilitySurroundingSafetyEquipmentSpecialRoomSuitableBusiness($property->id);
        $property->deleteImage($property->id);

        $imageProperty = $property->image;
        foreach($imageProperty as $temp)
        {
            Image::where('path', '=', $temp->image['path'])->forceDelete();
            Storage::delete($temp->image['path']);
        }

        // dd("done");

        $location = Location::find($property->location_id);
        $location->forceDelete();
        $property->forceDelete();
        session()->flash('success', 'Property was deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Property $property){
        $this->authorize('delete', $property);
        $property->delete();
        session()->flash('success', 'Property was trashed Successfully');
        return redirect(route('properties.index'));
    }

    public function trashed(){
        $trashed = Property::onlyTrashed()->paginate(1);
        return view('admin.properties.trashed', compact([
            'trashed',
        ]));
    }

    public function restore($id){
        $trashedProperty = Property::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $trashedProperty);
        $trashedProperty->restore();
        session()->flash('success', 'Property was restored Successfully!');
        return redirect(route('properties.index'));
    }

    /****************************************** CUSTOM VALIDATIONS *****************************************/
    private function validateBasicPropertyFields($request){
        $validator = Validator::make($request->all(), [
            'property-status' => Rule::in(['1', '2']),
            'property-type' => Rule::in(['1', '2'])
        ]);

        return (!$validator->fails());
    }

    private function validateOwnerDetailsFields($request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:10|max:10',
            'email' => 'required|email'
        ]);

        return (!$validator->fails());
    }

    private function validateLocationFields($request){
        $validator = Validator::make($request->all(), [
            'location-realtor-name' => 'max:255|nullable',
            'location-building-name' => 'required|min:2|max:255',
            'location-street' => 'required|min:2|max:255',
            'location-locality' => 'required|min:2|max:255',
            'location-landmark' => 'max:255|nullable',
            'location-town' => 'required|min:2|max:255',
            'location-city' => 'required|min:2|max:255',
            'location-pincode' => 'required|min:6|max:6',
            'location-state' => 'required|min:2|max:255',
            'location-country' => 'required|min:2|max:255',
            'location-latitude' => 'required',
            'location-longitude' => 'required',
        ]);

        return (!$validator->fails());
    }

    private function validateRentFields($request){
        $validator = Validator::make($request->all(), [
            'property-security-deposit-mode' => [
                'required',
                Rule::in(['1', '2'])],
            'property-amount' => 'required',
            'property-duration-of-agreement' => 'required',
            'property-months-of-notice' => 'required',
        ]);

        return (!$validator->fails());
    }

    private function validateSellFields($request){
        $validator = Validator::make($request->all(), [
            'property-price' => 'required',
        ]);

        return (!$validator->fails());
    }

    private function validateResidentialFields($request){
        $validator = Validator::make($request->all(), [
            'location-house-number' => 'required|min:2|max:255',
            'property-separate-toilets' => 'numeric|nullable',
            'property-bedrooms' => 'required',
            'property-furnished-status' => 'required', Rule::in(['1', '2']),
            'property-covered-parking' => 'required',
            'property-open-parking' => 'required',
            'property-facing-direction' => 'required|min:2|max:255',
        ]);

        return (!$validator->fails());
    }

    private function validateOfficeFields($request){
        $validator = Validator::make($request->all(), [
            'property-office-number' => 'required|min:2|max:255',
            'property-seats' => 'required',
            'property-cabin' => 'required',
            'property-meeting-room' => 'required',
            'property-reception-area' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'property-pantry' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'property-staircase' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'property-lift' => [
                'required',
                Rule::in(['1', '2'])
            ],
        ]);

        return (!$validator->fails());
    }

    private function validateShopfields($request){
        $validator = Validator::make($request->all(), [
            'property-shop-number' => 'required|min:2|max:255',
            'property-facade-width' => 'required',
            'property-facade-height' => 'required',
            'suitable_business' => 'required'
        ]);

        return (!$validator->fails());
    }

    private function validateOtherCommercialfields($request){
        $validator = Validator::make($request->all(), [
            'property-others-office-number' => 'required|min:2|max:255',
            'property-others-furnished-status' => 'required', Rule::in(['1', '2']),
            'property-others-covered-parking' => 'required',
            'property-others-open-parking' => 'required',
        ]);

        return (!$validator->fails());
    }

    private function validateCommonToAllFields($request){
        $validator = Validator::make($request->all(), [
            'property-bathrooms' => 'nullable',
            'property-total-floors' => 'nullable',
            'property-floor-number' => 'nullable',
            'property-age-property' => 'required',
            'property-description' => 'required|min:2',
            'property-carpet-area' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'property-availability-status' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'property-negotiable' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'seo_description' => 'max:255|nullable',
            'seo_keywords' => 'max:2000|nullable',
            'seo_og_title' => 'max:255|nullable',
            'seo_og_description' => 'max:255|nullable',
        ]);

        return (!$validator->fails());
    }

    private function validateUpdateCommonToAllFields($request){
        $validator = Validator::make($request->all(), [
            'property-detailed-type' => 'required|min:2|max:255',
            'property-bathrooms' => 'nullable',
            'property-total-floors' => 'nullable',
            'property-floor-number' => 'nullable',
            'property-age-property' => 'required',
            'property-description' => 'required|min:2',
            'property-carpet-area' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            'property-availability-status' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'property-negotiable' => [
                'required',
                Rule::in(['1', '2'])
            ],
            'seo_description' => 'max:255|nullable',
            'seo_keywords' => 'max:2000|nullable',
            'seo_og_title' => 'max:255|nullable',
            'seo_og_description' => 'max:255|nullable',
        ]);

        return (!$validator->fails());
    }

    /**************************************** CREATE TABLES ****************************************/
    private function createLocation($request){
        $location = Location::create([
            'realtor' => $request['location-realtor-name'],
            'building_name' => $request['location-building-name'],
            'street' => $request['location-street'],
            'landmark' => $request['location-landmark'],
            'locality' => $request['location-locality'],
            'town' => $request['location-town'],
            'city' => $request['location-city'],
            'pincode' => $request['location-pincode'],
            'state' => $request['location-state'],
            'country' => $request['location-country'],
            'latitude' => $request['location-latitude'],
            'longitude' => $request['location-longitude'],
        ]);

        return $location->id;
    }

    private function createRentDetails($request){
        $rent = RentDetail::create([
            'security_deposit_mode' => $request['property-security-deposit-mode'] == 1 ? 'Fixed' : 'Variable',
            'amount' => $request['property-amount'],
            'duration_of_agreement' => $request['property-duration-of-agreement'],
            'months_of_notice' => $request['property-months-of-notice'],
        ]);

        return $rent->id;
    }

    private function createProperty($request, $locationID, $rentID){
        $image = $request->file('image')->store('properties-feature-image');

        $location = Location::findOrFail($locationID);
        // dd($location->city);

        $property = Property::create([
            'location_id' => $locationID,
            'status' => $request['property-status'] == 1 ? 'Rent' : 'Sell',
            'type' => $request['property-type'] == 1 ? 'Residential' : 'Commercial',
            'detailed_type' => $request['property-detailed-type'],
            'rent_detail_id' => $rentID,
            'age_of_property' => $request['property-age-property'],
            'number_of_bathrooms' => $request['property-bathrooms'],
            'total_floors' => $request['property-total-floors'],
            'floor_number' => $request['property-floor-number'],
            'carpet' => $request['property-carpet-area'],
            'built_up' => $request['property-built-up-area'],
            'super_built_up' => $request['property-super-built-up-area'],
            'rera_number' => $request['property-rera-number'],
            'price' => $rentID == null ? $request['property-price'] : null,
            'negotiable' => $request['property-negotiable'] == 1? true : false,
            'under_construction' => $request['property-availability-status'] == 1 ? true : false,
            'available_by' => $request['property-availability-by'],
            'description' => $request['property-description'],
            'feature_image_path' => $image,
            'owner_name' => $request['name'],
            'owner_phone_number' => $request['phone'],
            'owner_email' => $request['email'],
            'slug' => Str::slug(lcfirst($request['property-type'] == 1 ? 'Residential' : 'Commercial')." ".$location->id." ".$request['property-carpet-area']." ".$location->city." ".$location->pincode." ".$location->state),
            'seo_description' => $request['seo-description'] ?? null,
            'seo_keywords' => $request['seo-keywords'] ?? null,
            'seo_og_title' => $request['seo-og-title'] ?? null,
            'seo_og_description' => $request['seo-og-description'] ?? null,
        ]);

        $property->manageImages($request);

        return $property->id;
    }

    private function createResidential($request, $propertyID){
        $residential = Residential::create([
            'property_id' => $propertyID,
            'house_no' => $request['location-house-number'],
            'number_of_bedrooms' => $request['property-bedrooms'],
            'number_of_separate_toilets' => $request['property-separate-toilets'],
            'furnishing' => $request['property-furnished-status'] == 1 ? true : false,
            'number_of_covered_parkings' => $request['property-covered-parking'],
            'number_of_open_parkings' => $request['property-open-parking'],
            'facing_direction' => $request['property-facing-direction'],
        ]);
    }

    private function createOffice($request, $propertyID){
        $office = Office::create([
            'property_id' => $propertyID,
            'office_no' => $request['property-office-number'],
            'number_of_seats' => $request['property-seats'],
            'number_of_cabins' => $request['property-cabin'],
            'number_of_meeting_rooms' => $request['property-meeting-room'],
            'reception_area' => $request['property-reception-area'] == 1 ? true : false,
            'pantry' => $request['property-pantry'] == 1 ? true : false,
            'staircase' => $request['property-staircase'] == 1 ? true : false,
            'lift' => $request['property-lift'] == 1 ? true : false,
        ]);
    }

    private function createShop($request, $propertyID){
        $shop = Shop::create([
            'property_id' => $propertyID,
            'shop_no' => $request['property-shop-number'],
            'facade_width' => $request['property-facade-width'],
            'facade_height' => $request['property-facade-height'],
        ]);

        foreach($request['suitable_business'] as $business){
            PropertySuitableBusiness::create([
                'name' => $business,
                'property_id' => $propertyID
            ]);
        }
    }

    private function createLand($request, $propertyID){
        $land = Land::create([
            'property_id' => $propertyID
        ]);

        return $land->id;
    }

    private function createOtherCommercial($request, $propertyID){
        $otherCommercial = OtherCommercial::create([
            'property_id' => $propertyID,
            'office_no' => $request['property-others-office-number'],
            'furnishing' => $request['property-others-furnished-status'] == 1 ? true : false,
            'number_of_covered_parkings' => $request['property-others-covered-parking'],
            'number_of_open_parkings' => $request['property-others-open-parking'],
            
        ]);
    }

    private function createAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $propertyID){

        if($request['special_room'][0] != null){
            foreach($request['special_room'] as $special_room){
                PropertySpecialRoom::create([
                    'name' => $special_room,
                    'property_id' => $propertyID
                ]);
            }
        }

        if($request['amenity_name'][0] != null){
            foreach($request['amenity_name'] as $amenity){
                PropertyAmenity::create([
                    'name' => $amenity,
                    'property_id' => $propertyID
                ]);
            }
        }

        if($request['facility_name'][0] != null){
            foreach($request['facility_name'] as $facility){
                PropertyFacility::create([
                    'name' => $facility,
                    'property_id' => $propertyID
                ]);
            }
        }

        if($request['surrounding_name'][0] != null){
            foreach($request['surrounding_name'] as $surrounding){
                PropertySurrounding::create([
                    'name' => $surrounding,
                    'property_id' => $propertyID
                ]);
            }
        }

        if($request['safety_equipment_name'][0] != null){
            foreach($request['safety_equipment_name'] as $safety_equipment){
                PropertySafetyEquipment::create([
                    'name' => $safety_equipment,
                    'property_id' => $propertyID
                ]);
            }
        }
    }

    /**************************************** UPDATE TABLES ****************************************/
    private function updateLocation($property, $request){
        $location = Location::findOrFail($property->location_id);

        $location->update([
            'realtor' => $request['location-realtor-name'],
            'building_name' => $request['location-building-name'],
            'street' => $request['location-street'],
            'landmark' => $request['location-landmark'],
            'locality' => $request['location-locality'],
            'town' => $request['location-town'],
            'city' => $request['location-city'],
            'pincode' => $request['location-pincode'],
            'state' => $request['location-state'],
            'country' => $request['location-country'],
            'latitude' => $request['location-latitude'],
            'longitude' => $request['location-longitude'],
        ]);

        return $location->id;
    }

    private function updateRentDetails($property, $request){
        $rent = RentDetail::findOrFail($property->rent_detail_id);
        $rent->update([
            'security_deposit_mode' => $request['property-security-deposit-mode'] == 1 ? 'Fixed' : 'Variable',
            'amount' => $request['property-amount'],
            'duration_of_agreement' => $request['property-duration-of-agreement'],
            'months_of_notice' => $request['property-months-of-notice'],
        ]);

        return $rent->id;
    }

    private function updateProperty($property, $request, $locationID, $rentID){

        $image = null;
        if($request->hasFile('image')){
            $image = $request->file('image')->store("properties-feature-image");
            $property->deleteImage();
        }

        $location = Location::findOrFail($locationID);
        $property->update([
            'detailed_type' => $request['property-detailed-type'],
            'age_of_property' => $request['property-age-property'],
            'number_of_bathrooms' => $request['property-bathrooms'],
            'total_floors' => $request['property-total-floors'],
            'floor_number' => $request['property-floor-number'],
            'carpet' => $request['property-carpet-area'],
            'built_up' => $request['property-built-up-area'],
            'super_built_up' => $request['property-super-built-up-area'],
            'rera_number' => $request['property-rera-number'],
            'price' => $rentID == null ? $request['property-price'] : null,
            'negotiable' => $request['property-negotiable'] == 1? true : false,
            'under_construction' => $request['property-availability-status'] == 1 ? true : false,
            'available_by' => $request['property-availability-by'],
            'description' => $request['property-description'],
            'feature_image_path' => $image != null ? $image : $property->feature_image_path,
            'owner_name' => $request['name'],
            'owner_phone_number' => $request['phone'],
            'owner_email' => $request['email'],
            'slug' => Str::slug(lcfirst($request['property-type'] == 1 ? 'Residential' : 'Commercial')." ".$location->id." ".$request['property-carpet-area']." ".$location->city." ".$location->pincode." ".$location->state),
            'seo_description' => $request['seo-description'] ?? null,
            'seo_keywords' => $request['seo-keywords'] ?? null,
            'seo_og_title' => $request['seo-og-title'] ?? null,
            'seo_og_description' => $request['seo-og-description'] ?? null,
        ]);

        $property->manageImages($request);

        return $property->id;
    }

    private function updateResidential($request, $property){
        $residential = Residential::where('property_id', '=', $property->id)->first();
        $residential->update([
            'house_no' => $request['location-house-number'],
            'number_of_bedrooms' => $request['property-bedrooms'],
            'number_of_separate_toilets' => $request['property-separate-toilets'],
            'furnishing' => $request['property-furnished-status'] == 1 ? true : false,
            'number_of_covered_parkings' => $request['property-covered-parking'],
            'number_of_open_parkings' => $request['property-open-parking'],
            'facing_direction' => $request['property-facing-direction'],
        ]);
    }

    private function updateOffice($request, $property){
        $office = Office::where('property_id', '=', $property->id)->first();
        $office->update([
            'office_no' => $request['property-office-number'],
            'number_of_seats' => $request['property-seats'],
            'number_of_cabins' => $request['property-cabin'],
            'number_of_meeting_rooms' => $request['property-meeting-room'],
            'reception_area' => $request['property-reception-area'] == 1 ? true : false,
            'pantry' => $request['property-pantry'] == 1 ? true : false,
            'staircase' => $request['property-staircase'] == 1 ? true : false,
            'lift' => $request['property-lift'] == 1 ? true : false,
        ]);
    }

    private function updateShop($request, $property){
        $shop = Shop::where('property_id', '=', $property->id)->first();
        $shop->update([
            'shop_no' => $request['property-shop-number'],
            'facade_width' => $request['property-facade-width'],
            'facade_height' => $request['property-facade-height'],
        ]);

        PropertySuitableBusiness::where('property_id', '=', $property->id)->forceDelete();
        foreach($request['suitable_business'] as $business){
            PropertySuitableBusiness::create([
                'name' => $business,
                'property_id' => $property->id
            ]);
        }
    }

    private function updateOtherCommercial($request, $property){
        $otherCommercial = OtherCommercial::where('property_id', '=', $property->id)->first();
        $otherCommercial->update([
            'office_no' => $request['property-others-office-number'],
            'furnishing' => $request['property-others-furnished-status'] == 1 ? true : false,
            'number_of_covered_parkings' => $request['property-others-covered-parking'],
            'number_of_open_parkings' => $request['property-others-open-parking'],
            
        ]);
    }

    private function updateAmenityFacilitySurroundingSafetyEquipmentSpecialRoom($request, $property){

        PropertyAmenity::where('property_id', '=', $property->id)->forceDelete();
        PropertyFacility::where('property_id', '=', $property->id)->forceDelete();
        PropertySurrounding::where('property_id', '=', $property->id)->forceDelete();
        PropertySafetyEquipment::where('property_id', '=', $property->id)->forceDelete();
        PropertySpecialRoom::where('property_id', '=', $property->id)->forceDelete();

        if($request['special_room'][0] != null){
            foreach($request['special_room'] as $special_room){
                if($special_room != null)
                {
                    PropertySpecialRoom::create([
                        'name' => $special_room,
                        'property_id' => $property->id
                    ]);
                }
            }
        }

        if($request['amenity_name'][0] != null){
            foreach($request['amenity_name'] as $amenity){
                if($amenity != null)
                {
                    PropertyAmenity::create([
                        'name' => $amenity,
                        'property_id' => $property->id
                    ]);
                }
            }
        }

        if($request['facility_name'][0] != null){
            foreach($request['facility_name'] as $facility){
                if($facility != null)
                {
                    PropertyFacility::create([
                        'name' => $facility,
                        'property_id' => $property->id
                    ]);
                }
            }
        }

        if($request['surrounding_name'] != null){
            foreach($request['surrounding_name'] as $surrounding){
                if($surrounding != null)
                {
                    PropertySurrounding::create([
                        'name' => $surrounding,
                        'property_id' => $property->id
                    ]);
                }
            }
        }

        if($request['safety_equipment_name'][0] != null){
            foreach($request['safety_equipment_name'] as $safety_equipment){
                if($safety_equipment != null)
                {
                    PropertySafetyEquipment::create([
                        'name' => $safety_equipment,
                        'property_id' => $property->id
                    ]);
                }
            }
        }
    }

    // private function insertUploadedPropertyImage($folderName, $propertyID){
    //     $allImages = Property::moveAllUploadedPropertyImages($folderName, $propertyID);
    //     $allImageNames = array();
    //     foreach($allImages as $path) {
    //         $image = pathinfo($path);
    //         $allImageNames[] = $image["basename"];
    //     }
    //     // dd($allImageNames);
    //     foreach($allImageNames as $image){
    //         $image = Image::create([
    //             'path' => "properties/$propertyID/$image"
    //         ]);
    //         // dd($image->path);

    //         ImageProperty::create([
    //             'image_id' => $image->id,
    //             'property_id' => $propertyID
    //         ]);
    //     }
    //     // dd("done");
    // }

    private function deleteAmenityFacilitySurroundingSafetyEquipmentSpecialRoomSuitableBusiness($propertyID){
        $propertyAmenity = PropertyAmenity::where('property_id', '=', $propertyID)->forceDelete();
        $propertyFacility = PropertyFacility::where('property_id', '=', $propertyID)->forceDelete();
        $propertySurroundings = PropertySurrounding::where('property_id', '=', $propertyID)->forceDelete();
        $propertySafetyEquipment = PropertySafetyEquipment::where('property_id', '=', $propertyID)->forceDelete();
        $propertySpecialRoom = PropertySpecialRoom::where('property_id', '=', $propertyID)->forceDelete();
        $propertySuitableBusiness = PropertySuitableBusiness::where('property_id', '=', $propertyID)->forceDelete();
    }
}
