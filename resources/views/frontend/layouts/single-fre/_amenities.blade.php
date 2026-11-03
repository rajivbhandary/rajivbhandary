<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Key Features</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
    @foreach ($fre->overviewKeypoints as $overviewKeypoint)
        <li class="col-md-3 mb-2"><i class="fa fa-check mr-2 text-primary"></i>{{$overviewKeypoint->name}}</li>
    @endforeach
    
    </ul>
</section>