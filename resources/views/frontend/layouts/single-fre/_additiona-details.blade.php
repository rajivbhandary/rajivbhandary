<section class="mt-2 pb-6 px-6 pt-5 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-4">Additional Details</h4>
    <div class="row">
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Price</dt>
            <dd>Rs. 22,15,00,000</dd>
        </dl>
        @if ($fre->project_type != null)
            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Project type</dt>
                <dd>{{$fre->project_type}}</dd>
            </dl>    
        @endif
        
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Built Up Area</dt>
            <dd>{{$fre->built_up_area}}</dd>
        </dl>
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Carpet Area</dt>
            <dd>{{$fre->carpet_area}}</dd>
        </dl>
        @if ($fre->car_parking != null)
            <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Parking</dt>
                <dd>{{$fre->car_parking}}</dd>
            </dl>
        @endif
        
       @if($fre->year_built != null)
        <dl class="col-sm-6 mb-0 d-flex"> <dt class="w-110px fs-14 font-weight-500 text-heading pr-2">Year build</dt>
            <dd>$fre->year_built</dd>
        </dl>
        @endif
    </div>
</section>