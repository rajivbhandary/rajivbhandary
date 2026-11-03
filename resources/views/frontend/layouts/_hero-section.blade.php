<section class="bg-secondary" data-animated-id="1"> </section>
<div id="hero-section" class="text-center bg-cover" data-animated-id="2">
<form action="{{route('frontend.advance-search')}}" method="POST">
	@csrf
	<div class="hero-section-overlay">
		<div class="container py-15 ">
			<div data-animate="fadeInDown" class="fadeInDown animated">
				<p class="text-white letter-spacing-34 fs-15 text-uppercase lh-186 mb-0 pt-1">let us find your home</p>
				<h2 class="fs-md-42 text-white pt-5">
				We have the most Listing in
				<span class="fs-md-52 font-weight-bold text-white pt-2 d-block">Mumbai</span>
				</h2>
				<div class="mxw-670 position-relative z-index-2">
					<input class="search-field" type="hidden" name="status" value="for-buy" data-default-value="">
					<ul class="nav nav-pills property-search-status-tab">
						<li class="nav-item" role="presentation"> <a class="nav-link btn shadow-none fs-13 letter-spacing-087 bg-dark-opacity-05 text-white hover-white text-uppercase bg-active-primary active rounded-0" data-toggle="pill" data-value="for-buy" href="#" role="tab" aria-selected="true">buy</a> </li>
						<li class="nav-item" role="presentation"> <a class="nav-link btn shadow-none fs-13 letter-spacing-087 bg-dark-opacity-05 text-white hover-white bg-active-primary text-uppercase rounded-0" data-toggle="pill" data-value="for-rent" href="#" role="tab" aria-selected="false">rent</a> </li>
					</ul>
					<div class="d-flex">
						<div class="position-relative w-100"> 
							<i class="fa fa-search text-dark fs-18 position-absolute pl-4 pos-fixed-left-center"></i>
							<input type="text" class="w-100 pl-8 py-4 bg-white border-0 fs-13 font-weight-500 text-gray-light lh-17" placeholder="Enter an address, neighborhood" name="search">
						</div>
						<button type="submit" class="btn btn-primary fs-16 font-weight-600 rounded-0"> Search </button>

						<div class="btn btn-secondary rounded-0" id="advance-search-btn"> 
							<a href="#advanced-search-filters-2" class="icon-primary btn  advanced-search w-100 shadow-none text-white text-left fs-16 font-weight-600 position-relative px-0 d-flex align-items-center rounded-0" data-toggle="collapse" data-target="#advanced-search-filters-2" aria-expanded="{{isset($request) ? 'true' : 'false'}}" aria-controls="advanced-search-filters-2">Advanced Search</a> </div>
					</div>
				</div>
			</div>
			<div class="container bg-primary">
				<div class="property-search d-none d-lg-block">
					<div class="row align-items-lg-center" id="accordion-2">
						<div id="advanced-search-filters-2" class="col-12 pb-6 pt-lg-2 collapse " data-parent="#accordion-2">
							<div class="row mx-n2">
								<div class="col-sm-4 col-md-3 pt-4 px-2">
									<label class="text-uppercase font-weight-500 letter-spacing-093 mb-1 text-gray">No. of Bedrooms</label>
									<div class="dropdown bootstrap-select form-control border-0 shadow-none form-control-lg bg-white p-0">
										<input id="property-bedrooms" type="number" class="form-control bg-white @error('property-bedrooms') is-invalid @enderror" name="property-bedrooms" value="{{ old('property-bedrooms') }}">
										@error('property-bedrooms')
											<p class="text-danger">{{ $message }}</p>
										@enderror
					
									</div>
								</div>

								<div class="col-sm-4 col-md-3 pt-4 px-2">
									<label class="text-uppercase font-weight-500 letter-spacing-093 mb-1 text-gray">Town</label>
									<div class="dropdown bootstrap-select form-control border-0 shadow-none form-control-lg bg-white p-0">
										<input id="location-town" type="text" class="form-control bg-white @error('location-town') is-invalid @enderror" name="location-town" value="{{ old('location-town') }}">
										@error('location-town')
											<p class="text-danger">{{ $message }}</p>
										@enderror
									</div>
								</div>

								<div class="col-sm-4 col-md-3 pt-4 px-2">
									<label class="text-uppercase font-weight-500 letter-spacing-093 mb-1 text-gray">Property Type</label>
									<div class="dropdown  border-0 shadow-none bg-white p-0">
										<select id="property-type" name="property-type" class="form-control bg-white height-40">
											<option value="">Select</option>
											@foreach($property_types as $property_type)
												<option value="{{ $property_type['id'] }}" {{ (old('property-type') && (in_array($property_type['id'], old('property-type'))) ? 'selected' : ' ') }}>{{ $property_type['value'] }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-sm-4 col-md-3 pt-4 px-2">
									<label class="text-uppercase font-weight-500 letter-spacing-093 mb-1 text-gray">Property Subtype</label>
									<div class="dropdown border-0 shadow-none bg-white p-0 ">
										<select id="property-subtype-select" name="property-subtype" class="form-control bg-white height-40">
											<option value="">Select</option>
											
										</select>
									</div>
								</div>

								
							</div>
							<div class="row d-flex justify-content-center">
								<div class="col-md-5 col-lg-5 pt-6 slider-range slider-range-primary">
									<label for="price-2" class="mb-4 text-white text-gray">Price Range</label>
									<div data-slider="true" data-slider-options="{&quot;min&quot;:0,&quot;max&quot;:200000000,&quot;values&quot;:[0,200000000],&quot;type&quot;:&quot;currency&quot;}" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content  text-gray">
										<div class="ui-slider-range ui-corner-all ui-widget-header  text-gray" ></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" ></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span></div>
									<div class="text-center mt-2">
										<input id="price-2" type="text" readonly="" class="border-0 amount text-center text-white bg-transparent font-weight-500 text-gray w-100" name="price"> </div>
								</div>
								<div class="col-md-5 col-lg-5 pt-6 slider-range slider-range-primary offset-lg-1">
									<label for="area-size-2" class="mb-4 text-white text-gray">Carpet Area Size</label>
									<div data-slider="true" data-slider-options="{&quot;min&quot;:0,&quot;max&quot;:4000,&quot;values&quot;:[0,4000],&quot;type&quot;:&quot;sqrt&quot;}" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content text-gray">
										<div class="ui-slider-range ui-corner-all ui-widget-header text-gray"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 21.4867%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
									</div>
									<div class="text-center mt-2">
										<input id="sqrt-size-2" type="text" readonly="" class="border-0 amount text-center text-white bg-transparent font-weight-500 text-gray" name="sqrt"> 
									</div>
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>