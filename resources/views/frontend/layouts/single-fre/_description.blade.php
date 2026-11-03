<section class="pb-8 px-6 pt-6 bg-white rounded-lg">
    <div class="row d-flex justify-content-between">
        <div class="col-md-8">
            <h2 class="fs-25 font-weight-600 lh-15 text-heading">{{$fre->title}}</h2>
        </div>
        <div class="col-md-4">
            <div class="text-lg-right">
                <p class="fs-22 text-heading font-weight-bold mb-0">₹ {{$fre->total_price}}</p>
            </div>
        </div>
        <p class="mb-0"><i class="fal fa-map-marker-alt mr-3"></i> {{$fre->location->locality}}, {{$fre->location->town}}, {{$fre->location->city}}</p>
    </div>
    <h4 class="fs-22 text-heading mt-6 mb-2">Description</h4>
    <p class="mb-0 lh-214">{{$fre->overview}}</p>

    <a href="#" data-toggle="modal" data-target="#enquiryModal" data-model="fre" data-id="{{ $fre->id }}" class="btn btn-primary enquiry-button mt-4">Enquire Now</a>
</section>