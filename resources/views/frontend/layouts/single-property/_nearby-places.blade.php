@if( count($property->getSurroundings()) > 0 )
<section class="mt-2 pb-5 px-6 pt-6 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-3">What is Nearby?</h4>
    <div>
        @foreach($property->getSurroundings() as $option)
            <p class="badge badge-primary d-inline-block m-1">{{$option->name}}</p>
        @endforeach
    </div>
</section>
@endif