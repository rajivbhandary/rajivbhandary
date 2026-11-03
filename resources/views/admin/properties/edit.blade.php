@extends('admin.layouts.template')

@section('title', 'Edit Property | Perks Properties')

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Create Property
                        </h3>
                    </div>
                </div>

                <form class="kt-form create-property" action="{{ route('properties.update', $property) }}" method="POST"
                        enctype="multipart/form-data" id="kt_form">

                    @csrf
                    @method('PUT')
                    <!-- begin:: Content -->
                    <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
                        <div class="kt-grid__item kt-wizard-v2__aside">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v2__nav">

                                <!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                                <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">

                                    <!-- Owner details-->
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-user"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Owner Profile
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Enter Owner's details
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Location details-->
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-map-location"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Location
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Choose Property's Location
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Property details -->
                                    <div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-list"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Property Description
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Tell us about your Property
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Area and availablility details-->
                                    <div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-squares-4"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Area & Availablitity
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Add your area & availability status
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Photos -->
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="la la-camera"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Media
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Add photos to your property
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pricing -->
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-coins"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    Pricing
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Pricing and other details
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SEO -->
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <i class="flaticon-imac"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    SEO Details
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc">
                                                    Make your property SEO friendly
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>

                            <!--end: Form Wizard Nav -->
                        </div>
                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper p-5">

                            <!--begin: Form Wizard Form-->

                                <!--begin: Form Wizard Step 1 Owner details-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">

                                    <div class="kt-heading kt-heading--md">Basic Property Details</div>
                                    <div class="kt-section">
                                        <div class="kt-section__content">
                                            <div class="row">
                                                <input type="hidden" name="folder_name" id="folder_name" value="{{ $folder_name }}">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Property Status <span class="text-danger">*</span></label>
                                                        <select id="property-status" disabled name="property-status" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach($property_status as $temp)
                                                                <option value="{{ $temp['id'] }}" {{ $temp['value'] == $property->status  ? 'selected' : ' ' }}>{{ $temp['value'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Property Type <span class="text-danger">*</span></label>
                                                        <select id="property-type" name="property-type" disabled class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach($property_types as $property_type)
                                                                <option value="{{ $property_type['id'] }}" {{ $property_type['value'] == $property->type  ? 'selected' : ' ' }}>{{ $property_type['value'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                @if($property->isCommercial())
                                                    <div id="property-commercial-select" class="col-xl-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Commercial Type<span class="text-danger">*</span></label>
                                                            <select id="property-commercials" name="property-commercials" disabled class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($property_commercials as $property_commercial)
                                                                    <option value="{{ $property_commercial['id'] }}" {{ $property_commercial['value'] == $property->getCommercialType()  ? 'selected' : ' ' }}>{{ $property_commercial['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                    <label class="">Detailed Type <span class="text-danger">*</span>
                                                        <span class="form-text text-mute">Example: Apartment, Bungalow, etc</span></label>
                                                        <input id="property-detailed-type" type="text" 
                                                                    class="form-control @error('property-detailed-type') is-invalid @enderror" 
                                                                    name="property-detailed-type" placeholder="Enter detailed type" 
                                                                    value="{{ old('property-detailed-type', $property->detailed_type) }}">
                                                        @error('property-detailed-type')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="kt-heading kt-heading--md">Owner's Details</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">
                                            <div class="form-group">
                                                <label>Name <span class="text-danger">*</span></label>
                                                <input id="owner-name" type="text" 
                                                            class="form-control @error('name') is-invalid @enderror" 
                                                            name="name" placeholder="Enter Name" 
                                                            value="{{ old('name', $property->owner_name) }}">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Phone <span class="text-danger">*</span></label>
                                                        <input id="owner-phone-number" type="tel" 
                                                                    class="form-control @error('phone') is-invalid @enderror" 
                                                                    name="phone" placeholder="Enter Phone"
                                                                    value="{{ old('phone', $property->owner_phone_number) }}">
                                                        @error('phone')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Email <span class="text-danger">*</span></label>
                                                        <input id="owner-email" type="email" 
                                                            class="form-control @error('email') is-invalid @enderror" name="email" 
                                                            placeholder="Enter Email"
                                                            value="{{ old('email', $property->owner_email) }}">
                                                        @error('email')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 1 Owner details-->

                                <!--begin: Form Wizard Step 2 Location-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Setup Property's Location</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="form-group">
                                                        <label>Realtor Name</label>
                                                        <input id="location-realtor-name" type="text" 
                                                            class="form-control @error('location-realtor-name') is-invalid @enderror" 
                                                            name="location-realtor-name" placeholder="Enter Realtor Name"
                                                            value="{{ old('location-realtor-name', $location->realtor) }}">
                                                        @error('location-realtor-name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>House No. <span class="text-danger">*</span></label>
                                                            <input id="location-house-number" type="text" 
                                                                class="form-control @error('location-house-number') is-invalid @enderror" 
                                                                name="location-house-number" 
                                                                placeholder="Enter House No."
                                                                value="{{ old('location-house-number', $property->getResidential()->house_no) }}">
                                                            @error('location-house-number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isShop())
                                                    <div class="col-xl-6 col-md-6 property-commercial-shops">
                                                        <div class="form-group">
                                                            <label>Shop No. <span class="text-danger">*</span></label>
                                                            <input id="property-shop-number" type="text" 
                                                                class="form-control @error('property-shop-number') is-invalid @enderror" 
                                                                name="property-shop-number" placeholder="Enter Shop Number"
                                                                value="{{ old('property-shop-number', $property->getShop()->shop_no) }}">
                                                            @error('property-shop-number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6 property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Office No. <span class="text-danger">*</span></label>
                                                            <input id="property-office-number" type="text" 
                                                                class="form-control @error('property-office-number') is-invalid @enderror" 
                                                                name="property-office-number" placeholder="Enter Office Number"
                                                                value="{{ old('property-office-number', $property->getOffice()->office_no) }}">
                                                            @error('property-office-number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOtherCommercial())
                                                    <div class="col-xl-6 col-md-6 property-commercial-others">
                                                        <div class="form-group">
                                                            <label>Office No. <span class="text-danger">*</span></label>
                                                            <input id="property-others-office-number" type="text" 
                                                                class="form-control @error('property-others-office-number') is-invalid @enderror" 
                                                                name="property-others-office-number" placeholder="Enter Office Number"
                                                                value="{{ old('property-others-office-number', $property->getOtherCommercials()->office_no) }}">
                                                            @error('property-others-office-number')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Building Name<span class="text-danger">*</span></label>
                                                        <input id="location-building-name" type="text" 
                                                            class="form-control @error('location-building-name') is-invalid @enderror" name="location-building-name" placeholder="Enter Building Name"
                                                            value="{{ old('location-building-name', $location->building_name) }}">
                                                        @error('location-building-name')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Street <span class="text-danger">*</span></label>
                                                        <input id="location-street" type="text" 
                                                            class="form-control @error('location-street') is-invalid @enderror" 
                                                            name="location-street" placeholder="Enter Street"
                                                            value="{{ old('location-street', $location->street) }}">
                                                        @error('location-street')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Landmark</label>
                                                        <input id="location-landmark" type="text" 
                                                            class="form-control @error('location-landmark') is-invalid @enderror" 
                                                            name="location-landmark" placeholder="Enter Landmark" 
                                                            value="{{ old('location-landmark', $location->landmark) }}">
                                                        @error('location-landmark')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Locality <span class="text-danger">*</span></label>
                                                        <input id="location-locality" type="text" 
                                                            class="form-control @error('location-locality') is-invalid @enderror" 
                                                            name="location-locality" placeholder="Enter Locality"
                                                            value="{{ old('location-locality', $location->locality) }}">
                                                        @error('location-locality')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Town <span class="text-danger">*</span></label>
                                                        <input id="location-town" type="text" 
                                                            class="form-control @error('location-town') is-invalid @enderror" 
                                                            name="location-town" placeholder="Enter Town"
                                                            value="{{ old('location-town', $location->town) }}">
                                                        @error('location-town')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>City <span class="text-danger">*</span></label>
                                                        <input id="location-city" type="text" 
                                                            class="form-control @error('location-city') is-invalid @enderror" 
                                                            name="location-city" placeholder="Enter City"
                                                            value="{{ old('location-city', $location->city) }}">
                                                        @error('location-city')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Pincode <span class="text-danger">*</span></label>
                                                        <input id="location-pincode" type="text" 
                                                            class="form-control @error('location-pincode') is-invalid @enderror" 
                                                            name="location-pincode" placeholder="Enter Pincode"
                                                            value="{{ old('location-pincode', $location->pincode) }}">
                                                        @error('location-pincode')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>State <span class="text-danger">*</span></label>
                                                        <input id="location-state" type="text" 
                                                            class="form-control @error('location-state') is-invalid @enderror" 
                                                            name="location-state" placeholder="Enter State"
                                                            value="{{ old('location-state', $location->state) }}">
                                                        @error('location-state')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Country <span class="text-danger">*</span></label>
                                                        <input id="location-country" type="text" 
                                                            class="form-control @error('location-country') is-invalid @enderror" 
                                                            name="location-country" placeholder="Enter country"
                                                            value="{{ old('location-country', $location->country) }}">
                                                        @error('location-country')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Latitude <span class="text-danger">*</span></label>
                                                        <input id="location-latitude" type="text" 
                                                            class="form-control @error('location-latitude') is-invalid @enderror" 
                                                            name="location-latitude" placeholder="Enter Latitude"
                                                            value="{{ old('location-latitude', $location->latitude) }}">
                                                        @error('location-latitude')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Longitude <span class="text-danger">*</span></label>
                                                        <input id="location-longitude" type="text" 
                                                            class="form-control @error('location-longitude') is-invalid @enderror" name="location-longitude" placeholder="Enter Longitude"
                                                            value="{{ old('location-longitude', $location->longitude) }}">
                                                        @error('location-longitude')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 2 Location-->
                                <!--begin: Form Wizard Step 3 Property Description-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Property Profile</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">

                                            <div class="row">

                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>Bedrooms <span class="text-danger">*</span></label>
                                                            <input id="property-bedrooms" type="number" 
                                                                class="form-control @error('property-bedrooms') is-invalid @enderror" 
                                                                name="property-bedrooms" placeholder="Enter number of Bedrooms"
                                                                value="{{ old('property-bedrooms', $property->getResidential()->number_of_bedrooms) }}">
                                                            @error('property-bedrooms')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-6 property-bathroom">
                                                    <div class="form-group">
                                                        <label>Bathrooms <span class="text-danger">*</span></label>
                                                        <input id="property-bathrooms" type="number" 
                                                            class="form-control @error('property-bathrooms') is-invalid @enderror" name="property-bathrooms" placeholder="Enter number of Bathrooms"
                                                            value="{{ old('property-bathrooms', ($property->number_of_bathrooms)) }}">
                                                        @error('property-bathrooms')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if($property->isShop())
                                                    <div class="col-xl-6 col-md-6 property-commercial-shops">
                                                        <div class="form-group">
                                                            <label>Facade Width (meters)<span class="text-danger">*</span></label>
                                                            <input id="property-facade-width" type="text" 
                                                                class="form-control @error('property-facade-width') is-invalid @enderror" name="property-facade-width" placeholder="Enter Facade Width"
                                                                value="{{ old('property-facade-width', $property->getShop()->facade_width) }}">
                                                            @error('property-facade-width')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isShop())
                                                    <div class="col-xl-6 col-md-6 property-commercial-shops">
                                                        <div class="form-group">
                                                            <label>Facade Height (meters)<span class="text-danger">*</span></label>
                                                            <input id="property-facade-height" type="text" 
                                                                class="form-control @error('property-facade-height') is-invalid @enderror" name="property-facade-height" placeholder="Enter Facade Height"
                                                                value="{{ old('property-facade-height', $property->getShop()->facade_width) }}">
                                                            @error('property-facade-height')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>Separate Toilets</label>
                                                            <input id="property-separate-toilets" type="number" 
                                                                class="form-control @error('property-separate-toilets') is-invalid @enderror" name="property-separate-toilets" placeholder="Enter number of Separate Toilets"
                                                                value="{{ old('property-separate-toilets', $property->getResidential()->number_of_separate_toilets) }}">
                                                            @error('property-separate-toilets')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-6 property-total-floor">
                                                    <div class="form-group">
                                                        <label>Total Floors <span class="text-danger">*</span></label>
                                                        <input id="property-total-floors" type="number" 
                                                            class="form-control @error('property-total-floors') is-invalid @enderror" name="property-total-floors" placeholder="Enter number of Total Floors"
                                                            value="{{ old('property-total-floors', ($property->total_floors)) }}">
                                                        @error('property-total-floors')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @else
                                                        <span
                                                            class="form-text text-muted">Please enter 0 if ground floor</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6 property-floor-number">
                                                    <div class="form-group">
                                                        <label>Floor Number <span class="text-danger">*</span></label>
                                                        <input id="property-floor-number" type="number" 
                                                            class="form-control @error('property-floor-number') is-invalid @enderror" name="property-floor-number" placeholder="Enter number of Floor Number"
                                                            value="{{ old('property-floor-number', ($property->floor_number)) }}">
                                                        @error('property-floor-number')
                                                            <p class="text-danger">{{ $message }}</p>
                                                            @else
                                                        <span
                                                            class="form-text text-muted">Please enter 0 if ground floor</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6  property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Seats <span class="text-danger">*</span></label>
                                                            <input id="property-seats" type="number" 
                                                                class="form-control @error('property-seats') is-invalid @enderror" name="property-seats" placeholder="Enter number of Seats"
                                                                value="{{ old('property-seats', $property->getOffice()->number_of_seats) }}">
                                                            @error('property-seats')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6  property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Cabins <span class="text-danger">*</span></label>
                                                            <input id="property-cabin" type="number" 
                                                                class="form-control @error('property-cabin') is-invalid @enderror" name="property-cabin" placeholder="Enter number of Cabins"
                                                                value="{{ old('property-cabin', $property->getOffice()->number_of_cabins) }}">
                                                            @error('property-cabin')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6  property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Meeting Rooms <span class="text-danger">*</span></label>
                                                            <input id="property-meeting-room" type="number" 
                                                                class="form-control @error('property-meeting-room') is-invalid @enderror" name="property-meeting-room" placeholder="Enter number of Meeting Rooms"
                                                                value="{{ old('property-meeting-room', $property->getOffice()->number_of_meeting_rooms) }}">
                                                            @error('property-meeting-room')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6 property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Reception Area <span class="text-danger">*</span></label>
                                                            <select id="property-reception-area" 
                                                                name="property-reception-area" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($yes_no_options as $yes_no_option)
                                                                    <option value="{{ $yes_no_option['id'] }}" 
                                                                    {{ (old('property-reception-area', $property->getOffice()->reception_area + 1) 
                                                                    && (($yes_no_option['id']-1) == ($property->getOffice()->reception_area))  ? 'selected' : ' ') }}>
                                                                    {{ $yes_no_option['value'] }}</option>
                                                                @endforeach
                                                                {{ $property_type['value'] == $property->type  ? 'selected' : ' ' }}
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6 property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Pantry <span class="text-danger">*</span></label>
                                                            <select id="property-pantry" name="property-pantry" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($yes_no_options as $yes_no_option)
                                                                    <option value="{{ $yes_no_option['id'] }}" {{ (old('property-pantry', ($property->getOffice()->pantry + 1)) 
                                                                    && ($yes_no_option['id']-1 == $property->getOffice()->pantry)  ? 'selected' : ' ') }}>
                                                                    {{ $yes_no_option['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6 property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Staircase <span class="text-danger">*</span></label>
                                                            <select id="property-staircase" name="property-staircase" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($yes_no_options as $yes_no_option)
                                                                    <option value="{{ $yes_no_option['id'] }}" {{ (old('property-staircase', ($property->getOffice()->staircase + 1)) 
                                                                    && ($yes_no_option['id'] - 1 == $property->getOffice()->staircase)  ? 'selected' : ' ') }}>
                                                                    {{ $yes_no_option['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOffice())
                                                    <div class="col-xl-6 col-md-6 property-commercial-office">
                                                        <div class="form-group">
                                                            <label>Lift <span class="text-danger">*</span></label>
                                                            <select id="property-lift" name="property-lift" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($yes_no_options as $yes_no_option)
                                                                    <option value="{{ $yes_no_option['id'] }}" 
                                                                    {{ (old('property-lift', ($property->getOffice()->lift + 1)) 
                                                                    && ($yes_no_option['id'] - 1 == $property->getOffice()->lift)  ? 'selected' : ' ') }}>
                                                                    {{ $yes_no_option['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>Furnished Status <span class="text-danger">*</span></label>
                                                            <select id="property-furnished-status" name="property-furnished-status" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($furnished_status as $option)
                                                                    <option value="{{ $option['id'] }}" {{ (old('property-furnished-status', ($property->getResidential()->furnishing + 1)) 
                                                                    && ($option['id'] - 1 == $property->getResidential()->furnishing)  ? 'selected' : ' ') }}>
                                                                    {{ $option['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOtherCommercial())
                                                    <div class="col-xl-6 col-md-6 property-commercial-others">
                                                        <div class="form-group">
                                                            <label>Furnished Status <span class="text-danger">*</span></label>
                                                            <select id="property-others-furnished-status" name="property-others-furnished-status" class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach($furnished_status as $option)
                                                                    <option value="{{ $option['id'] }}" {{ (old('property-furnished-status', ($property->getOtherCommercials()->furnishing + 1)) 
                                                                        && ($option['id'] - 1 == $property->getOtherCommercials()->furnishing)  ? 'selected' : ' ') }}>
                                                                        {{ $option['value'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isShop())
                                                    <div class="col-xl-6 col-md-12 property-commercial-shops">
                                                        <div class="form-group">
                                                            <label class="">Add Suitable Business <span class="text-danger">*</span>
                                                            <span class="form-text text-mute">Example: Grocery, Electronics Shop, etc</span></label>
                                                            
                                                            <button id="add_suitable_business" type="button"
                                                                    class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                                <i class="la la-plus"></i>
                                                                Add
                                                            </button>
                                                            <div class="kt-form__section kt-form__section--first">
                                                                <div class="kt-wizard-v2__form" id="suitable_business_container">
                                                                @if(count($property->getsuitableBusiness()) > 0)
                                                                    @php($i=1)
                                                                        @foreach ($property->getsuitableBusiness() as $business)
                                                                    <div class="row suitable_business" id="suitable_business_{{ $i }}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="suitable_business">Name</label>
                                                                            <input type="text" class="form-control" id="suitable_business_{{ $i }}"
                                                                                name="suitable_business[]" value="{{ $business->name }}"
                                                                                placeholder="Enter Suitable Business">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{ $i }}"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @php($i++)
                                                                    @endforeach

                                                                @else 
                                                                    <div class="row suitable_business" id="suitable_business_1">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="suitable_business">Name</label>
                                                                            <input type="text" class="form-control" id="suitable_business_1"
                                                                                name="suitable_business[]" value=""
                                                                                placeholder="Enter Suitable Business">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="1" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="1"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-12 add-special-room">
                                                    <div class="form-group">
                                                        <label class="">Add Special Rooms 
                                                        <span class="form-text text-mute">Example: Pooja Room, Store Room, Study Room, etc</span></label>
                                                        
                                                        <button id="add_special_room" type="button"
                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i>
                                                            Add
                                                        </button>
                                                        <div class="kt-form__section kt-form__section--first">
                                                            <div class="kt-wizard-v2__form" id="special_room_container">
                                                            @if(count($property->getSpecialRooms()) > 0)
                                                                @php($i=1)
                                                                    @foreach ($property->getSpecialRooms() as $room)
                                                                    <div class="row special_room" id="special_room_row_{{ $i }}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="special_room">Name</label>
                                                                            <input type="text" class="form-control" id="special_room_{{$i}}"
                                                                                name="special_room[]" value="{{ $room->name }}"
                                                                                placeholder="Enter Special Room">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{ $i }}"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @php($i++)
                                                                    @endforeach

                                                                @else 
                                                                    <div class="row special_room" id="special_room_1">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="special_room">Name</label>
                                                                            <input type="text" class="form-control" id="special_room_1"
                                                                                name="special_room[]" value=""
                                                                                placeholder="Enter Special Room">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="1" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="1"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-12 add-amenity">
                                                    <div class="form-group">
                                                        <label class="">Add Amenities 
                                                        <span class="form-text text-mute">Example: Gym, Swimming Pool, Garden etc.</span></label>
                                                        
                                                        <button id="add_amenity" type="button"
                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i>
                                                            Add
                                                        </button>
                                                        <div class="kt-form__section kt-form__section--first">
                                                            <div class="kt-wizard-v2__form" id="amenity_container">
                                                                @if(count($property->getAmenities()) > 0)
                                                                @php($i=1)
                                                                    @foreach ($property->getAmenities() as $amenity)
                                                                    <div class="row amenity_row" id="amenity_row_{{$i}}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="amenity_name">Name</label>
                                                                            <input type="text" class="form-control" id="amenity_name_{{$i}}"
                                                                                name="amenity_name[]" value="{{ $amenity->name }}"
                                                                                placeholder="Enter Amenity">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{$i}}"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    @php($i++)
                                                                    @endforeach
                                                                @else
                                                                <div class="row amenity_row" id="amenity_row_1">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="amenity_name">Name</label>
                                                                            <input type="text" class="form-control" id="amenity_name_1"
                                                                                name="amenity_name[]" value=""
                                                                                placeholder="Enter Amenity">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="1" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="1"></i></button>
                                                                        </div>
                                                                    </div>   
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-12 add-facility">
                                                    <div class="form-group">
                                                        <label class="">Add Facility  
                                                        <span class="form-text text-mute">Example: Wifi, Break Room, Power Backup etc.</span></label>
                                                        
                                                        <button id="add_facility" type="button"
                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i>
                                                            Add
                                                        </button>
                                                        <div class="kt-form__section kt-form__section--first">
                                                            <div class="kt-wizard-v2__form" id="facility_container">
                                                            @if(count($property->getFacilities()) > 0)
                                                                @php($i=1)
                                                                    @foreach ($property->getFacilities() as $facilty)
                                                                    <div class="row facility_row" id="facility_row_{{ $i }}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="facility_name">Name</label>
                                                                            <input type="text" class="form-control" id="facility_name_{{ $i }}"
                                                                                name="facility_name[]" value="{{ $facilty->name }}"
                                                                                placeholder="Enter Facility">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{ $i }}"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @php($i++)
                                                                    @endforeach
                                                                @else
                                                                    <div class="row facility_row" id="facility_row_1">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="facility_name">Name</label>
                                                                            <input type="text" class="form-control" id="facility_name_1"
                                                                                name="facility_name[]" value=""
                                                                                placeholder="Enter Facility">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="1" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="1"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>   
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-12">
                                                    <div class="form-group">
                                                        <label class="">Add Surrounding   
                                                        <span class="form-text text-mute">Example: Railway Station, Metro, Jain Temple, etc.</span></label>
                                                        
                                                        <button id="add_surrounding" type="button"
                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i>
                                                            Add
                                                        </button>
                                                        <div class="kt-form__section kt-form__section--first">
                                                            <div class="kt-wizard-v2__form" id="surrounding_container">
                                                            @if(count($property->getSurroundings()) > 0)
                                                                @php($i=1)
                                                                    @foreach ($property->getSurroundings() as $surrounding)
                                                                    <div class="row surrounding_row" id="surrounding_row_{{ $i }}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="surrounding_name">Name</label>
                                                                            <input type="text" class="form-control" id="surrounding_name_{{ $i }}"
                                                                                name="surrounding_name[]" value="{{ $surrounding->name }}"
                                                                                placeholder="Enter Surroundings">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{ $i }}"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @php($i++)
                                                                    @endforeach
                                                                @else
                                                                    <div class="row surrounding_row" id="surrounding_row_1">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="surrounding_name">Name</label>
                                                                            <input type="text" class="form-control" id="surrounding_name_1"
                                                                                name="surrounding_name[]" value=""
                                                                                placeholder="Enter Surroundings">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="1" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="1"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>   
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-12 add-safety-equipment">
                                                    <div class="form-group">
                                                        <label class="">Add Safety Equipments   
                                                        <span class="form-text text-mute">Example: Smoke & CO Alarm,  Fire Extinguisher, Fire sprinkler systems, etc.</span></label>
                                                        
                                                        <button id="add_safety_equipment" type="button"
                                                                class="btn btn-bold btn-sm btn-label-brand pull-right">
                                                            <i class="la la-plus"></i>
                                                            Add
                                                        </button>
                                                        <div class="kt-form__section kt-form__section--first">
                                                            <div class="kt-wizard-v2__form" id="safety_equipment_container">
                                                            @if(count($property->getSafetyEquipments()) > 0)
                                                                @php($i=1)
                                                                @foreach ($property->getSafetyEquipments() as $equipment)
                                                                    <div class="row safety_equipment_row" id="safety_equipment_row_{{ $i }}">
                                                                        <div class="form-group col-xd-6 col-md-6">
                                                                            <label for="safety_equipment_name">Name</label>
                                                                            <input type="text" class="form-control" id="safety_equipment_name_{{ $i }}"
                                                                                name="safety_equipment_name[]" value="{{ $equipment->name }}"
                                                                                placeholder="Enter Safety Equipments">
                                                                        </div>
                                                                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                            <button data-id="{{ $i }}" type="button"
                                                                                    class="btn btn-label-brand btn-icon delete"><i
                                                                                    class='kt-menu__link-icon flaticon2-trash delete'
                                                                                    data-id="{{ $i }}"></i></button>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    @php($i++)
                                                                @endforeach
                                                            @else
                                                                <div class="row safety_equipment_row" id="safety_equipment_row_1">
                                                                    <div class="form-group col-xd-6 col-md-6">
                                                                        <label for="safety_equipment_name">Name</label>
                                                                        <input type="text" class="form-control" id="safety_equipment_name_1"
                                                                            name="safety_equipment_name[]" value=""
                                                                            placeholder="Enter Safety Equipments">
                                                                    </div>
                                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                        <button data-id="1" type="button"
                                                                                class="btn btn-label-brand btn-icon delete"><i
                                                                                class='kt-menu__link-icon flaticon2-trash delete'
                                                                                data-id="1"></i></button>
                                                                    </div>
                                                                    
                                                                </div>
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>No. of Covered Parking <span class="text-danger">*</span></label>
                                                            <input id="property-covered-parking" type="number" 
                                                                class="form-control @error('property-covered-parking') is-invalid @enderror" name="property-covered-parking" 
                                                                placeholder="Enter No. of Covered Parking"
                                                                value="{{ old('property-covered-parking', $property->getResidential()->number_of_covered_parkings) }}">
                                                            @error('property-covered-parking')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>No. of Open Parking <span class="text-danger">*</span></label>
                                                            <input id="property-open-parking" type="number" 
                                                                class="form-control @error('property-open-parking') is-invalid @enderror" name="property-open-parking" 
                                                                placeholder="Enter No. of Open Parking"
                                                                value="{{ old('property-open-parking', $property->getResidential()->number_of_open_parkings) }}">
                                                            @error('property-open-parking')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isOtherCommercial())
                                                    <div class="col-xl-6 col-md-6 property-commercial-others">
                                                        <div class="form-group">
                                                            <label>No. of Covered Parking <span class="text-danger">*</span></label>
                                                            <input id="property-others-covered-parking" type="number" 
                                                                class="form-control @error('property-others-covered-parking') is-invalid @enderror" name="property-others-covered-parking" 
                                                                placeholder="Enter No. of Covered Parking"
                                                                value="{{ old('property-others-covered-parking', $property->getOtherCommercials()->number_of_covered_parkings) }}">
                                                            @error('property-others-covered-parking')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif


                                                @if($property->isOtherCommercial())
                                                    <div class="col-xl-6 col-md-6 property-commercial-others">
                                                        <div class="form-group">
                                                            <label>No. of Open Parking <span class="text-danger">*</span></label>
                                                            <input id="property-others-open-parking" type="number" 
                                                                class="form-control @error('property-others-open-parking') is-invalid @enderror" name="property-others-open-parking" 
                                                                placeholder="Enter No. of Open Parking"
                                                                value="{{ old('property-others-open-parking', $property->getOtherCommercials()->number_of_open_parkings) }}">
                                                            @error('property-others-open-parking')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($property->isResidential())
                                                    <div class="col-xl-6 col-md-6 property-residential">
                                                        <div class="form-group">
                                                            <label>Facing Direction <span class="text-danger">*</span></label>
                                                            <input id="property-facing-direction" type="text" 
                                                                class="form-control @error('property-facing-direction') is-invalid @enderror" name="property-facing-direction" placeholder="Enter Facing Direction"
                                                                value="{{ old('property-facing-direction', $property->getResidential()->facing_direction) }}">
                                                            @error('property-facing-direction')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Age of Property (years)<span class="text-danger">*</span></label>
                                                        <input id="property-age-property" type="text" 
                                                            class="form-control @error('property-age-property') is-invalid @enderror" name="property-age-property" placeholder="Enter Age of Property"
                                                            value="{{ old('property-age-property', $property->age_of_property) }}">
                                                        @error('property-age-property')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Description <span class="text-danger">*</span></label>
                                                        <textarea class="form-control @error('property-description') is-invalid @enderror" id="property-description" name="property-description" rows="4"
                                                        >{{ old('property-description', $property->description) }}</textarea>
                                                        @error('property-description')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 3 Property Description-->

                                <!--begin: Form Wizard Step 4 Area & availablity-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Fill up Area & Availablity Details</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">
                                            <div class="row">
                                            <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Carpet Area (sq.ft)<span class="text-danger">*</span></label>
                                                        <input id="property-carpet-area" type="text" 
                                                            class="form-control @error('property-carpet-area') is-invalid @enderror" name="property-carpet-area" placeholder="Enter Carpet Area"
                                                            value="{{ old('property-carpet-area', $property->carpet) }}">
                                                        @error('property-carpet-area')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Built-Up Area (sq.ft)</label>
                                                        <input id="property-built-up-area" type="text" 
                                                            class="form-control @error('property-built-up-area') is-invalid @enderror" name="property-built-up-area" placeholder="Enter Built-Up Area"
                                                            value="{{ old('property-built-up-area', $property->built_up) }}">
                                                        @error('property-built-up-area')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Super Built-Up Area (sq.ft)</label>
                                                        <input id="property-super-built-up-area" type="text" 
                                                            class="form-control @error('property-super-built-up-area') is-invalid @enderror" name="property-super-built-up-area" placeholder="Enter Super Built-Up Area"
                                                            value="{{ old('property-super-built-up-area', $property->super_built_up) }}">
                                                        @error('property-super-built-up-area')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Rera Number</label>
                                                        <input id="property-rera-number" type="text" 
                                                            class="form-control @error('property-rera-numbe') is-invalid @enderror" 
                                                            name="property-rera-number" placeholder="Enter Rera Number"
                                                            value="{{ old('property-rera-number', $property->rera_number) }}">
                                                        @error('property-rera-numbe')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Availability Status <span class="text-danger">*</span></label>
                                                        <select id="property-availability-status" name="property-availability-status" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach($availability_status as $option)
                                                                <option value="{{ $option['id'] }}" {{ (old('property-availability-status', ($property->under_construction + 1)) 
                                                                        && ($option['id'] - 1 == $property->under_construction)  ? ' ' : 'selected') }}>
                                                                        {{ $option['value'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Available by</label>
                                                        <div class="input-group date">
                                                            <input type="text" class="form-control" 
                                                            readonly 
                                                            value="{{ old('property-availability-by', $property->available_by) }}" 
                                                            name="property-availability-by"
                                                                    class="form-control"
                                                                    placeholder="Select date" 
                                                                    id="property-availability-by"/>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="la la-calendar"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        @error('property-availability-by')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 4 Area & availablity-->

                                <!--begin: Form Wizard Step 5 Media Iamges-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Images</div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Feature Image <span class="text-danger">*</span></label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline" id="image">
                                                    <div class="kt-avatar__holder"
                                                    style="background-image: url('{{ asset("storage/$property->feature_image_path") }}');"></div>
                                                    <label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
                                                        data-original-title="Change image">
                                                        <i class="fas fa-pen"></i>
                                                        <input type="file" name="image" value="">
                                                    </label>
                                                    @error('image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                    @else
                                                        <span class="form-text text-muted">Size of the file should not be more than 1MB (500 x 300)</span>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <label>Upload more images</label>
                                            <div class="kt-portlet__body">
                                                <div class="kt-uppy" id="kt_uppy_6">
                                                <input type="file" name="files[]" multiple="" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Form Wizard Step Media Iamges-->

                                <!--begin: Form Wizard Step 6 Pricing-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Enter your Pricing Details</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">

                                            @if($property->isRent())
                                                <div class="property-rent">
                                                    <div class="row">

                                                        <div class="col-xl-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Security Deposit Mode <span class="text-danger">*</span></label>
                                                                <select id="property-security-deposit-mode" name="property-security-deposit-mode" class="form-control">
                                                                    <option value="">Select</option>
                                                                    @foreach($security_deposite_mode as $mode)
                                                                        <option value="{{ $mode['id'] }}" {{ (old('property-security-deposit-mode', ($property->getRentDetails()->security_deposit_mode)) 
                                                                        && ($mode['value'] == $property->getRentDetails()->security_deposit_mode)  ? 'selected' : ' ') }}>
                                                                        {{ $mode['value'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>              
                                                        </div>

                                                        <div class="col-xl-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Amount ( <i class="fa fa-inr"></i> )<span class="text-danger">*</span></label>
                                                                <input id="property-amount" type="text" 
                                                                    class="form-control @error('property-amount') is-invalid @enderror" 
                                                                    name="property-amount" placeholder="Enter Amount"
                                                                    value="{{ old('property-amount', $property->getRentDetails()->amount) }}">
                                                                @error('property-amount')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Duration of Agreement (months)<span class="text-danger">*</span></label>
                                                                <input id="property-duration-of-agreement" type="text" 
                                                                    class="form-control @error('property-duration-of-agreement') is-invalid @enderror" 
                                                                    name="property-duration-of-agreement" 
                                                                    placeholder="Enter the Duration of Agreement"
                                                                    value="{{ old('property-duration-of-agreement', $property->getRentDetails()->duration_of_agreement) }}">
                                                                @error('property-duration-of-agreement')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-6 col-md-6">
                                                            <div class="form-group">
                                                                <label>Months of Notice<span class="text-danger">*</span></label>
                                                                <input id="property-months-of-notice" type="text" 
                                                                    class="form-control @error('property-months-of-notice') is-invalid @enderror" 
                                                                    name="property-months-of-notice" placeholder="Enter number of Months of Notice"
                                                                    value="{{ old('property-months-of-notice', $property->getRentDetails()->months_of_notice) }}">
                                                                @error('property-months-of-notice')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                @if($property->isSell())
                                                    <div class="col-xl-6 col-md-6 property-sell">
                                                        <div class="form-group">
                                                            <label>Price ( <i class="fa fa-inr"></i> )<span class="text-danger">*</span></label>
                                                            <input id="property-price" type="text" 
                                                                class="form-control @error('property-price') is-invalid @enderror" 
                                                                name="property-price" 
                                                                placeholder="Enter Price"
                                                                value="{{ old('property-price', $property->price) }}">
                                                            @error('property-price')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Negotiable <span class="text-danger">*</span></label>
                                                        <select id="property-negotiable" name="property-negotiable" class="form-control">
                                                            <option value="">Select</option>
                                                            @foreach($yes_no_options as $yes_no_option)
                                                                <option value="{{ $yes_no_option['id'] }}" {{ (old('property-negotiable', ($property->negotiable + 1)) 
                                                                        && ($yes_no_option['id'] - 1 == $property->negotiable)  ? 'selected' : ' ') }}>
                                                                        {{ $yes_no_option['value'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 6 Pricing-->

                                <!--begin: Form Wizard Step 6 SEO-->
                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                    <div class="kt-heading kt-heading--md">Let's make your property well known on the net</div>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v2__form">
                                            <div class="row">

                                                <div class="col-xd-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>SEO Description</label>
                                                        <input type="seo-description" name="seo-description"
                                                            class="form-control @error('seo-description') is-invalid @enderror"
                                                            placeholder="Enter SEO Description" value="{{ old('seo-description') }}">
                                                        @error('seo-description')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @else
                                                        <span
                                                            class="form-text text-muted">Short description to make the property SEO friendly</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xd-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>SEO Keywords</label>
                                                        <input type="seo-keywords" name="seo-keywords"
                                                            class="form-control @error('seo-keywords') is-invalid @enderror"
                                                            placeholder="Enter SEO Keywords" value="{{ old('seo-keywords') }}">
                                                        @error('seo-keywords')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @else
                                                        <span class="form-text text-muted">Write comma separated words to make the property SEO friendly</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xd-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>SEO OG Title</label>
                                                        <input type="seo-og-title" name="seo-og-title"
                                                            class="form-control @error('seo-og-title') is-invalid @enderror"
                                                            placeholder="Enter SEO OG Title" value="{{ old('seo-og-title') }}">
                                                        @error('seo-og-title')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @else
                                                        <span
                                                            class="form-text text-muted">Title displayed when you share the property link</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xd-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>SEO OG Description</label>
                                                        <input type="seo-og-description" name="seo-og-description"
                                                            class="form-control @error('seo-og-description') is-invalid @enderror"
                                                            placeholder="Enter SEO OG Description" value="{{ old('seo-og-description') }}">
                                                        @error('seo-og-description')
                                                        <p class="text-danger">{{ $message }}</p>
                                                        @else
                                                            <span class="form-text text-muted">Short description displayed when you share the property link</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end: Form Wizard Step 6 SEO-->

                                <!--begin: Form Actions -->
                                <div class="kt-form__actions">
                                    <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                        Previous
                                    </button>
                                    <button type="submit" class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u pull-right" data-ktwizard-type="action-submit">
                                        Submit
                                    </button>
                                    <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u pull-right" data-ktwizard-type="action-next">
                                        Next Step
                                    </button>
                                </div>


                            <!--end: Form Wizard Form-->
                        </div>
                    </div>
                    <!-- end:: Content -->
                
                </form>
                <!--end: Form Actions -->
            </div>
        <!--end::Portlet-->
        </div>
    </div>
</div>


@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')

    <style>
        .kt-avatar .kt-avatar__holder {
            width: 500px;
            height: 300px;
        }

        /* .swal2-container{
            display: none;
        } */
    </style>

    <link href="{{ asset('assets/admin/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/pages/wizard/wizard-2.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('scripts')

    <!-- <script src="{{ asset('assets/admin/js/pages/custom/wizard/wizard-2.js') }}" type="text/javascript"></script> -->
    <script src="{{ asset('assets/admin/js/pages/components/extended/dual-listbox.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/plugins/custom/uppy/uppy.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('assets/admin/js/pages/crud/file-upload/uppy.js')}}" type="text/javascript"></script>

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset('assets/admin/js/page-level/properties/edit-property.js') }}" type="text/javascript"></script>
    <!--end::Page Scripts -->

    <script>
        initPropertyID("{{ $property->id }}")
        initPropertyImages("{{ $property->getUploadedImages() }}");
        initVariables("{{count($property->getSpecialRooms()) + 1}}", "{{count($property->getAmenities()) + 1}}", "{{count($property->getFacilities()) + 1}}", "{{count($property->getSurroundings()) + 1}}", "{{count($property->getSafetyEquipments()) + 1}}", "{{count($property->getSuitableBusiness()) + 1}}");
    </script>
@endsection