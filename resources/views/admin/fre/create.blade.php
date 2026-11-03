@extends('admin.layouts.template')

@section('title', 'Create FRE | Perks Properties')

@section('content')
	<!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-4">
							<div class="kt-portlet">
								<div class="kt-portlet__body kt-portlet__body--fit">
									<div class="kt-portlet__head">
										<div class="kt-portlet__head-label">
											<h3 class="kt-portlet__head-title">
												Create FRE
											</h3>
										</div>
									</div>
									<!--begin: Form Wizard Form-->
									<form class="kt-form create-fre" action="{{ route('fre.store') }}" 
											method="POST" enctype="multipart/form-data" id="kt_form">			
											@csrf
										<div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
											<div class="kt-grid__item kt-wizard-v2__aside">

												<!--begin: Form Wizard Nav -->
												<div class="kt-wizard-v2__nav">

													<!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
													<div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-globe"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		FRE Details
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Set Up Basic Details
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-coins"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Investment Information
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		All you need is to invest in a good place.
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-list"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Property Details
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Tell us more about your property
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
														<div class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-map-location"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Location Details
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Choose Your Property Location
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-squares-4"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Developer Information
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		About the Developer
																	</div>
																</div>
															</div>
														</div>
														<div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
															<div class="kt-wizard-v2__nav-body">
																<div class="kt-wizard-v2__nav-icon">
																	<i class="flaticon-book"></i>
																</div>
																<div class="kt-wizard-v2__nav-label">
																	<div class="kt-wizard-v2__nav-label-title">
																		Tenant Overview
																	</div>
																	<div class="kt-wizard-v2__nav-label-desc">
																		Add Tenant Overview
																	</div>
																</div>
															</div>
														</div>
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
																		Make your FRE SEO friendly
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												<!--end: Form Wizard Nav -->
											</div>
											<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper p-5">
													<!--begin: Form Wizard FRE Overview-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
														<div class="kt-heading kt-heading--md">Enter Project Overview</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="form-group">
																	<label>FRE Name <span class="text-danger">*</span></label>
																	<input type="text" class="form-control" name="title" placeholder="XYZ Ganzia" value="{{ old('title') }}">
																	@error('title')
																	<p class="text-danger">{{ $message }}</p>
																	@enderror
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Commercial Space <span class="text-danger">*</span></label>
																			<input type="text" class="form-control" name="commercial_space" placeholder="" value="{{ old('commercial_space') }}">
																			@error('commercial_space')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Available by <span class="text-danger">*</span></label>
																			<div class="input-group date">
																				<input type="text" class="form-control" readonly value="{{ old('fre_availability_by') }}" 
																				name="fre_availability_by"
																						class="form-control"
																						placeholder="Select date" 
																						id="fre_availability_by"/>
																				<div class="input-group-append">
																					<span class="input-group-text">
																						<i class="la la-calendar"></i>
																					</span>
																				</div>
																			</div>
																			@error('fre_availability_by')
																			<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>															
																<div class="col-xl-6 pl-0">
																	<div class="form-group">
																		<label>FRE Rera Number <span class="text-danger">*</span></label>
																		<input id="fre_rera_number" type="text" 
																			class="form-control @error('fre_rera_number') is-invalid @enderror" 
																			name="fre_rera_number" placeholder="Enter Rera Number"
																			value="{{ old('fre_rera_number') }}">
																		@error('fre_rera_number')
																			<p class="text-danger">{{ $message }}</p>
																		@enderror
																	</div>
																</div>
																<div class="form-group">
																	<label>Overview <span class="text-danger">*</span></label>
																	<textarea class="form-control @error('overview') is-invalid @enderror" id="overview" name="overview" rows="4"
																	value="{{ old('overview') }}"></textarea>
																	@error('overview')
																		<p class="text-danger">{{ $message }}</p>
																	@enderror
																</div>
																<div class="col-xl-12 col-md-12">
																	<div class="form-group">
																		<label class="">Add Overview Keypoints
																		<span class="form-text text-mute">Example: A Grade Property, MNC Tenant, Upcoming Metro Line</span></label>
																		
																		<button id="add_overview_keypoint" type="button"
																				class="btn btn-bold btn-sm btn-label-brand pull-right">
																			<i class="la la-plus"></i>
																			Add
																		</button>
																		<div class="kt-form__section kt-form__section--first">
																			<div class="kt-wizard-v2__form" id="overview_keypoint_container">
																				<div class="row overview_keypoint_row" id="overview_keypoint_row_1">
																					<div class="form-group">
																						<label for="overview_keypoint_name">Name</label>
																						<input type="text" class="form-control" id="overview_keypoint_name_1"
																							name="overview_keypoint_name[]"
																							placeholder="Enter Overview Keypoint">
																					</div>
																					<div class="d-flex align-items-center justify-content-center">
																						<button data-id="1" type="button"
																								class="btn btn-label-brand btn-icon delete"><i
																								class='kt-menu__link-icon flaticon2-trash delete'
																								data-id="1"></i></button>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Step FRE Overview-->

													<!--begin: Form Wizard Investment Information-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Investment Information</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Total Price <span class="text-danger">*</span></label>
																			<input id="total_price" type="number" 
																				class="form-control @error('total_price') is-invalid @enderror" 
																				name="total_price" placeholder="Enter Total Price"
																				value="{{ old('total_price') }}">
																			@error('total_price')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Minimum Investment <span class="text-danger">*</span></label>
																			<input id="minimum_investment" type="text" 
																				class="form-control @error('minimum_investment') is-invalid @enderror" 
																				name="minimum_investment" placeholder="Enter Minimum Investment Amount"
																				value="{{ old('minimum_investment') }}">
																			@error('minimum_investment')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Rental Yield</label>
																			<input id="rental_yield" type="text" 
																				class="form-control @error('rental_yield') is-invalid @enderror" 
																				name="rental_yield" placeholder="Enter Rental Yield"
																				value="{{ old('rental_yield') }}">
																			@error('rental_yield')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Gross Yield</label>
																			<input id="gross_yield" type="text" 
																				class="form-control @error('gross_yield') is-invalid @enderror" 
																				name="gross_yield" placeholder="Enter Gross Yield"
																				value="{{ old('gross_yield') }}">
																			@error('rental_yield')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Expected IRR</label>
																			<input id="expected_irr" type="text" 
																				class="form-control @error('expected_irr') is-invalid @enderror" 
																				name="expected_irr" placeholder="Enter Expected IRR"
																				value="{{ old('expected_irr') }}">
																			@error('expected_irr')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Target Multiplier</label>
																			<input id="target_multiplier" type="text" 
																				class="form-control @error('target_multiplier') is-invalid @enderror" 
																				name="target_multiplier" placeholder="Enter Target Multiplier"
																				value="{{ old('target_multiplier') }}">
																			@error('target_multiplier')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Investment Information-->

													<!--begin: Form Wizard Property Details-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Enter Property Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="form-group">
																	<label>Property Overview <span class="text-danger">*</span></label>
																	<textarea class="form-control @error('details_info') is-invalid @enderror" id="details_info" name="details_info" rows="4"
																	value="{{ old('details_info') }}"></textarea>
																	@error('details_info')
																		<p class="text-danger">{{ $message }}</p>
																	@enderror
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Floor Plate</label>
																			<input id="floor_plate" type="text" 
																				class="form-control @error('floor_plate') is-invalid @enderror" 
																				name="floor_plate" placeholder="Enter Floor Plate"
																				value="{{ old('floor_plate') }}">
																			@error('floor_plate')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Floor</label>
																			<input id="floor" type="text" 
																				class="form-control @error('floor') is-invalid @enderror" 
																				name="floor" placeholder="Enter No. Of Floors or Floor No."
																				value="{{ old('floor') }}">
																			@error('floor')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Car Parking</label>
																			<input id="car_parking" type="number" 
																				class="form-control @error('car_parking') is-invalid @enderror" 
																				name="car_parking" placeholder="Enter Car Parking Number"
																				value="{{ old('car_parking') }}">
																			@error('car_parking')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Elevators</label>
																			<input id="elevators" type="number"
																				class="form-control @error('elevators') is-invalid @enderror" 
																				name="elevators" placeholder="Enter No. Of Elevators"
																				value="{{ old('elevators') }}">
																			@error('elevators')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Built Type Area <span class="text-danger">*</span></label>
																			<input id="built_up_area" type="text" 
																				class="form-control @error('built_up_area') is-invalid @enderror" 
																				name="built_up_area" placeholder="Enter Built Type Area"
																				value="{{ old('built_up_area') }}">
																			@error('built_up_area')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Carpet Area <span class="text-danger">*</span></label>
																			<input id="carpet_area" type="text" 
																				class="form-control @error('carpet_area') is-invalid @enderror" 
																				name="carpet_area" placeholder="Enter Carpet Area"
																				value="{{ old('carpet_area') }}">
																			@error('carpet_area')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Property Type</label>
																			<input id="property_type" type="text" 
																				class="form-control @error('property_type') is-invalid @enderror" 
																				name="property_type" placeholder="Enter Property Type"
																				value="{{ old('property_type') }}">
																			@error('property_type')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="col-xl-12 col-md-12">
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
																				<div class="row surrounding_row" id="surrounding_row_1">
																					<div class="form-group">
																						<label for="surrounding_name">Name</label>
																						<input type="text" class="form-control" id="surrounding_name_1"
																							name="surrounding_name[]"
																							placeholder="Enter Surroundings">
																					</div>
																					<div class="d-flex align-items-center justify-content-center">
																						<button data-id="1" type="button"
																								class="btn btn-label-brand btn-icon delete"><i
																								class='kt-menu__link-icon flaticon2-trash delete'
																								data-id="1"></i></button>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-xl-12 col-md-12">
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
																				<div class="row amenity_row" id="amenity_row_1">
																					<div class="form-group">
																						<label for="amenity_name">Name</label>
																						<input type="text" class="form-control" id="amenity_name_1"
																							name="amenity_name[]"
																							placeholder="Enter Amenity">
																					</div>
																					<div class="d-flex align-items-center justify-content-center">
																						<button data-id="1" type="button"
																								class="btn btn-label-brand btn-icon delete"><i
																								class='kt-menu__link-icon flaticon2-trash delete'
																								data-id="1"></i></button>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Property Details-->

													<!--begin: Form Wizard Step 5 Media Iamges-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Images</div>
														
														<div class="row">
															<div class="form-group col-md-6">
																<label>Feature Image <span class="text-danger">*</span></label>
																<div class="col-lg-9 col-xl-6">
																	<div class="kt-avatar kt-avatar--outline" id="image">
																		<div class="kt-avatar__holder"
																			style="background-image: url({{ asset('assets/admin/media/placeholders/500x300.jpg') }})"></div>
																		<label class="kt-avatar__upload" data-toggle="kt-tooltip" title=""
																			data-original-title="Change image">
																			<i class="fas fa-pen"></i>
																			<input id="fre_feature_image" type="file" name="fre_feature_image" value="">
																		</label>
																		@error('fre_feature_image')
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


													<!--begin: Form Wizard Location-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Setup Property's Location</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																
																<div class="row">


																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Building Name <span class="text-danger">*</span></label>
																			<input id="location_building_name" type="text" 
																				class="form-control @error('location_building_name') is-invalid @enderror" name="location_building_name" placeholder="Enter Building Name"
																				value="{{ old('location_building_name') }}">
																			@error('location_building_name')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Street <span class="text-danger">*</span></label>
																			<input id="location_street" type="text" 
																				class="form-control @error('location_street') is-invalid @enderror" 
																				name="location_street" placeholder="Enter Street"
																				value="{{ old('location_street') }}">
																			@error('location_street')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Landmark</label>
																			<input id="location_landmark" type="text" 
																				class="form-control @error('location_landmark') is-invalid @enderror" 
																				name="location_landmark" placeholder="Enter Landmark" 
																				value="{{ old('location_landmark') }}">
																			@error('location_landmark')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Locality <span class="text-danger">*</span></label>
																			<input id="location_locality" type="text" 
																				class="form-control @error('location_locality') is-invalid @enderror" 
																				name="location_locality" placeholder="Enter Locality"
																				value="{{ old('location_locality') }}">
																			@error('location_locality')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Town <span class="text-danger">*</span></label>
																			<input id="location_town" type="text" 
																				class="form-control @error('location_town') is-invalid @enderror" 
																				name="location_town" placeholder="Enter Town"
																				value="{{ old('location_town') }}">
																			@error('location_town')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>City <span class="text-danger">*</span></label>
																			<input id="location_city" type="text" 
																				class="form-control @error('location_city') is-invalid @enderror" 
																				name="location_city" placeholder="Enter City"
																				value="{{ old('location_city') }}">
																			@error('location_city')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Pincode <span class="text-danger">*</span></label>
																			<input id="location_pincode" type="text" 
																				class="form-control @error('location_pincode') is-invalid @enderror" 
																				name="location_pincode" placeholder="Enter Pincode"
																				value="{{ old('location_pincode') }}">
																			@error('location_pincode')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>State <span class="text-danger">*</span></label>
																			<input id="location_state" type="text" 
																				class="form-control @error('location_state') is-invalid @enderror" 
																				name="location_state" placeholder="Enter State"
																				value="{{ old('location_state') }}">
																			@error('location_state')
																				<p class="text_danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Country <span class="text-danger">*</span></label>
																			<input id="location_country" type="text" 
																				class="form-control @error('location_country') is-invalid @enderror" 
																				name="location_country" placeholder="Enter country"
																				value="{{ old('location_country') }}">
																			@error('location_country')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>

																<div class="row">
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Latitude <span class="text-danger">*</span></label>
																			<input id="location_latitude" type="text" 
																				class="form-control @error('location_latitude') is-invalid @enderror" 
																				name="location_latitude" placeholder="Enter Latitude"
																				value="{{ old('location_latitude') }}">
																			@error('location_latitude')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6 col-md-6">
																		<div class="form-group">
																			<label>Longitude <span class="text-danger">*</span></label>
																			<input id="location_longitude" type="text" 
																				class="form-control @error('location_longitude') is-invalid @enderror" name="location_longitude" placeholder="Enter Longitude"
																				value="{{ old('location_longitude') }}">
																			@error('location_longitude')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--begin: Form Wizard Developer Details-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Enter Developer Details</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Developer Name <span class="text-danger">*</span></label>
																			<input id="developer_name" type="text" 
																				class="form-control @error('developer_name') is-invalid @enderror" name="developer_name" placeholder="Enter Realtor Name"
																				value="{{ old('developer_name') }}">
																			@error('developer_name')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Rera Number</label>
																			<input id="developer_rera_number" type="text" 
																				class="form-control @error('developer_rera_number') is-invalid @enderror" 
																				name="developer_rera_number" placeholder="Enter Rera Number"
																				value="{{ old('developer_rera_number') }}">
																			@error('developer_rera_number')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<label>Developer Overview <span class="text-danger">*</span></label>
																	<textarea class="form-control @error('developer_overview') is-invalid @enderror" id="developer_overview" name="developer_overview" rows="4"
																	value="{{ old('developer_overview') }}"></textarea>
																	@error('developer_overview')
																		<p class="text-danger">{{ $message }}</p>
																	@enderror
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Developer Details-->

													<!--begin: Form Wizard Tenant Overview-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Enter Tenant Overview</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="form-group">
																		<label>Info <span class="text-danger">*</span></label>
																		<textarea class="form-control @error('tenant_overview') is-invalid @enderror" id="tenant_overview" name="tenant_overview" rows="4"
																		value="{{ old('tenant_overview') }}"></textarea>
																		@error('tenant_overview')
																			<p class="text-danger">{{ $message }}</p>
																		@enderror
																	</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Founded</label>
																			<input id="founded" type="text" 
																				class="form-control @error('founded') is-invalid @enderror" 
																				name="founded" placeholder="Enter Year Founded"
																				value="{{ old('founded') }}">
																			@error('founded')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Industry</label>
																			<input id="industry" type="text" 
																				class="form-control @error('industry') is-invalid @enderror" 
																				name="industry" placeholder="Enter Industry Type"
																				value="{{ old('industry') }}">
																			@error('industry')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Market Cap</label>
																			<input id="market_cap" type="text" 
																				class="form-control @error('market_cap') is-invalid @enderror" 
																				name="market_cap" placeholder="Enter Market Cap"
																				value="{{ old('market_cap') }}">
																			@error('market_cap')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Employees</label>
																			<input id="employees" type="number" 
																				class="form-control @error('employees') is-invalid @enderror" 
																				name="employees" placeholder="Enter No. Of Employees"
																				value="{{ old('employees') }}">
																			@error('employee')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
																<div class="row">
																	<div class="col-xl-6">
																		<div class="form-group">
																			<label>Website</label>
																			<input id="website" type="url" 
																				class="form-control @error('website') is-invalid @enderror" 
																				name="website" placeholder="Enter Website Link"
																				value="{{ old('website') }}">
																			@error('website')
																				<p class="text-danger">{{ $message }}</p>
																			@enderror
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<!--end: Form Wizard Tenant Overview-->

													<!--begin: Form Wizard-->
													<div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
														<div class="kt-heading kt-heading--md">Let's make your FRE well known on the net</div>
														<div class="kt-form__section kt-form__section--first">
															<div class="kt-wizard-v2__form">
																<div class="row">

																	<div class="col-xd-12 col-md-12">
																		<div class="form-group">
																			<label>SEO Description</label>
																			<input type="seo_description" name="seo_description"
																				class="form-control @error('seo_description') is-invalid @enderror"
																				placeholder="Enter SEO Description" value="{{ old('seo_description') }}">
																			@error('seo_description')
																			<p class="text-danger">{{ $message }}</p>
																			@else
																			<span
																				class="form-text text-muted">Short description to make the blog SEO friendly</span>
																			@enderror
																		</div>
																	</div>

																	<div class="col-xd-12 col-md-12">
																		<div class="form-group">
																			<label>SEO Keywords</label>
																			<input type="seo_keywords" name="seo_keywords"
																				class="form-control @error('seo_keywords') is-invalid @enderror"
																				placeholder="Enter SEO Keywords" value="{{ old('seo_keywords') }}">
																			@error('seo_keywords')
																			<p class="text-danger">{{ $message }}</p>
																			@else
																			<span class="form-text text-muted">Write comma separated words to make the blog SEO friendly</span>
																			@enderror
																		</div>
																	</div>

																	<div class="col-xd-12 col-md-12">
																		<div class="form-group">
																			<label>SEO OG Title</label>
																			<input type="seo_og_title" name="seo_og_title"
																				class="form-control @error('seo_og_title') is-invalid @enderror"
																				placeholder="Enter SEO OG Title" value="{{ old('seo_og_title') }}">
																			@error('seo_og_title')
																			<p class="text-danger">{{ $message }}</p>
																			@else
																			<span
																				class="form-text text-muted">Title displayed when you share the blog link</span>
																			@enderror
																		</div>
																	</div>

																	<div class="col-xd-12 col-md-12">
																		<div class="form-group">
																			<label>SEO OG Description</label>
																			<input type="seo_og_description" name="seo_og_description"
																				class="form-control @error('seo_og_description') is-invalid @enderror"
																				placeholder="Enter SEO OG Description" value="{{ old('seo_og_description') }}">
																			@error('seo_og_description')
																			<p class="text-danger">{{ $message }}</p>
																			@else
																				<span class="form-text text-muted">Short description displayed when you share the blog link</span>
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



													<!--end: Form Actions -->

												<!--end: Form Wizard Form-->
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
@endsection

@section('styles')
    <style>
        .kt-avatar .kt-avatar__holder {
            width: 500px;
            height: 300px;
        }
    </style>
	<link href="{{ asset('assets/admin/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/css/pages/wizard/wizard-2.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/page-level/fre/create-fre.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/admin/js/pages/components/extended/dual-listbox.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/admin/plugins/custom/uppy/uppy.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('assets/admin/js/pages/crud/file-upload/uppy.js')}}" type="text/javascript"></script>
    
@endsection
