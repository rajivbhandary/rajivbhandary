<section class="mt-2 pb-6 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Additional Details</h4>
    <div class="row">
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Price</dt>
            <dd>₹ {{ $property->isRent() ? $property->getRentDetails()->amount : $property->price }} {{ $property->isRent() ? '/ month' : '' }}</dd>
        </dl>
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Property type</dt>
            <dd>{{ $property->type }}</dd>
        </dl>
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Property status</dt>
            <dd>{{ $property->status }}</dd>
        </dl>

        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Detailed Type</dt>
            <dd>{{ $property->detailed_type }}</dd>
        </dl>

        @if($property->isResidential())
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Facing</dt>
            <dd>{{ $property->getResidential()->facing_direction }}</dd>
        </dl>
        @endif
        @if($property->isResidential() && $property->getResidential()->number_of_separate_toilets != null)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Separate Toilets</dt>
            <dd>{{ $property->getResidential()->number_of_separate_toilets }}</dd>
        </dl>
        @endif

        @if($property->isResidential() || $property->isOtherCommercial())
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Furnishing Status</dt>
            @if($property->isResidential())
                <dd>{{ $property->getResidential()->furnishing == 0 ? 'Fully Furnished' : 'Unfurnished'}}</dd>
            @elseif ($property->isOtherCommercial())
                <dd>{{ $property->getOtherCommercials()->furnishing == 0 ? 'Fully Furnished' : 'Unfurnished'}}</dd>
            @endif
        </dl>
        @endif

        @if($property->isOffice())
            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Seats</dt>
                <dd>{{ $property->getOffice()->number_of_seats }}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Cabins</dt>
                <dd>{{ $property->getOffice()->number_of_cabins }}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Meeting Rooms</dt>
                <dd>{{ $property->getOffice()->number_of_meeting_rooms }}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Reception Area</dt>
                <dd>{{ $property->getOffice()->reception_area == 0 ? 'Yes' : 'No' }}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Pantry</dt>
                <dd>{{ $property->getOffice()->pantry == 0 ? 'Yes' : 'No' }}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Stair case</dt>
                <dd>{{ $property->getOffice()->stair_case == 0 ? 'Yes' : 'No'}}</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Lift</dt>
                <dd>{{ $property->getOffice()->lift == 0 ? 'Yes' : 'No' }}</dd>
            </dl>
        @endif

        @if($property->isShop())
            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Facade Width</dt>
                <dd>{{ $property->getShop()->facade_width }} meters</dd>
            </dl>

            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Facade Height</dt>
                <dd>{{ $property->getShop()->facade_height }} meters</dd>
            </dl>
        @endif

        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Total Floors</dt>
            <dd>{{ $property->total_floors == 0 ? 'Ground Floor' : $property->total_floors}}</dd>
        </dl>
        @if($property->total_floors > 0)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Floor Number</dt>
            <dd>{{ $property->floor_number == 0 ? 'Ground Floor' : $property->floor_number }}</dd>
        </dl>
        @endif
        @if($property->isResidential())
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Bedrooms</dt>
            <dd>{{ $property->getResidential()->number_of_bedrooms }}</dd>
        </dl>
        @endif
        @if($property->built_up != null)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Built Up</dt>
            <dd>{{ $property->built_up }}</dd>
        </dl>
        @endif
        @if($property->super_built_up != null)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Super Built Up</dt>
            <dd>{{ $property->super_built_up }}</dd>
        </dl>
        @endif

        @if($property->rera_number != null)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Rera Number</dt>
            <dd>{{ $property->rera_number }}</dd>
        </dl>
        @endif
        @if($property->isResidential())
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Open Parking</dt>
            <dd>{{ $property->getResidential()->number_of_covered_parkings }}</dd>
        </dl>
        @endif
        @if($property->isOtherCommercial())
            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Open Parking</dt>
                <dd>{{ $property->getOtherCommercials()->number_of_covered_parkings }}</dd>
            </dl>
        @endif
    </div>
</section>