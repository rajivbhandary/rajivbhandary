<section class="pb-8 px-6 pt-6 bg-white rounded-lg">
    <ul class=" list-inline d-sm-flex align-items-sm-center mb-2">
        <li class="list-inline-item badge badge-{{lcfirst($property->status)}} mr-3">{{ $property->status }}</li>
        <li class="list-inline-item badge badge-{{lcfirst($property->type)}} mr-3">{{ $property->type }}</li>
        <li class="list-inline-item mr-2 mt-2 mt-sm-0"><i class="fal fa-clock mr-1"></i>{{ $property->created_at->diffForHumans() }}</li>
        <!-- <li class="list-inline-item mt-2 mt-sm-0"><i class="fa fa-eye mr-1"></i>1039 views</li>  -->
    </ul>
    <div class="d-sm-flex justify-content-sm-between">
        <div>
            <h2 class="fs-35 font-weight-600 lh-15 text-heading">{{ $property->getLocationDetails()->building_name }}</h2>
            <p class="mb-0">{{$property->getLocationDetails()->town . ', ' .$property->getLocationDetails()->city }}</p>
        </div>
        <div class="mt-2 text-lg-right">
            <p class="fs-22 text-heading font-weight-bold mb-0">₹ {{ $property->isRent() ? $property->getRentDetails()->amount : $property->price }} {{ $property->isRent() ? '/ month' : '' }}</p>
        </div>
    </div>
    <h4 class="fs-22 text-heading mt-6 mb-2">Description</h4>
    <div class="mb-0 lh-214 property-description">{!! \App\Support\Html::clean($property->description) !!}</div>

    <a href="#" data-toggle="modal" data-target="#enquiryModal" data-model="property" data-id="{{ $property->id }}" class="btn btn-primary enquiry-button mt-4">Enquire Now</a>
</section>