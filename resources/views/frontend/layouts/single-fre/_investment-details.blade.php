<section class="mt-2 pb-7 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Investment Information</h4>
    <ul class="list-unstyled mb-0 row no-gutters">
        <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Total Sale price: {{$fre->total_price}}</li>
        <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Minimum Investment: Rs. {{$fre->minimum_investment}}</li>
        @if($fre->rental_yield != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Rental Yield: {{$fre->rental_yield}}%</li>
        @endif
        @if ($fre->expected_irr != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Expected IRR on exit: {{$fre->expected_irr}}%</li>    
        @endif
        @if ($fre->target_multiplier != null)
            <li class="col-md-6 mb-2"><i class="fa fa-check mr-2 text-primary"></i>Target Multiplier: {{$fre->target_multiplier}}x</li>    
        @endif
        
    </ul>
</section>