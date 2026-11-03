@if( count($property->getAmenities()) > 0 )
<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Amenities</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        @foreach ($property->getAmenities() as $amenity)
            <li class="pr-3"><i class="fa fa-check mr-2 text-primary"></i>{{$amenity->name}}</li>
        @endforeach
    </ul>
</section>
@endif

@if( count($property->getFacilities()) > 0 )
<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Facilities</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        @foreach ($property->getFacilities() as $option)
            <li class="pr-3"><i class="fa fa-check mr-2 text-primary"></i>{{$option->name}}</li>
        @endforeach
    </ul>
</section>
@endif

@if( count($property->getSpecialRooms()) > 0 )
<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Special Rooms</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        @foreach ($property->getSpecialRooms() as $option)
            <li class="pr-3"><i class="fa fa-check mr-2 text-primary"></i>{{$option->name}}</li>
        @endforeach
    </ul>
</section>
@endif

@if( count($property->getSafetyEquipments()) > 0 )
<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Safety Equipments</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        @foreach ($property->getSafetyEquipments() as $option)
            <li class="pr-3"><i class="fa fa-check mr-2 text-primary"></i>{{$option->name}}</li>
        @endforeach
    </ul>
</section>
@endif

@if( count($property->getsuitableBusiness()) > 0 )
<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Suitable business</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        @foreach ($property->getsuitableBusiness() as $option)
            <li class="pr-3"><i class="fa fa-check mr-2 text-primary"></i>{{$option->name}}</li>
        @endforeach
    </ul>
</section>
@endif