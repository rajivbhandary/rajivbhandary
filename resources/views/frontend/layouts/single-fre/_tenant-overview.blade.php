<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Tenant Overview</h4>
    <p class="mb-2 lh-214">{{$fre->tenant_overview}}</p>
    <ul class="list-unstyled mb-2 row no-gutters">
        @if ($fre->founded != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Founded: <strong>{{$fre->founded}}</strong></li>    
        @endif
        
        @if ($fre->industry != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Industry: <strong>{{$fre->industry}}</strong></li>    
        @endif
        @if($fre->market_cap != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Market Cap: <strong>₹ {{$fre->market_cap}}</strong></li>
        @endif
        @if ($fre->employees)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Employees: <strong>{{$fre->employees}}</strong></li>    
        @endif
        
    </ul>
</section>