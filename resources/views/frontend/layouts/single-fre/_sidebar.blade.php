<div class="pb-8 px-6 pt-6 bg-white rounded-lg">
    <h4 class="fs-22 text-heading mb-3">Similar FRE</h4>

    @foreach ($latest_fre as $fre)

    <div class="card shadow-hover-1 mb-3">
        <div class="hover-change-image bg-hover-overlay rounded-lg card-img-top">
            <img src="{{asset("storage/$fre->feature_image_path")}}" alt="{{$fre->title}}">
            <a href="{{ route('frontend.single-fre', $fre->slug) }}" class="stretched-link"></a>
        </div>
        <div class="card-body pt-3">
            <p class="fs-17 font-weight-bold text-heading mb-0">₹ {{$fre->total_price}}</p>
            <h2 class="card-title fs-16 lh-2 mb-0">
                <a href="{{route('frontend.single-fre', $fre->slug)}}" class="text-dark hover-primary">{{$fre->title}}</a>
            </h2>
            <p class="card-text font-weight-500 text-gray-light mb-2">{{$fre->overview}}</p>
            <div class="row">
                @if ($fre->rental_yield != null)
                     <div class="col-sm-6 mb-0">
                        <p class="mb-0 text-gray">Avg. Return Yeild</p>
                        <p class="mb-0 text-black">{{$fre->rental_yield}}%</p>
                     </div>
                  @endif
                  @if($fre->gross_yield != null)
                  <div class="col-sm-6 mb-0">
                     <p class="mb-0 text-gray">Gross Yiels</p>
                     <p class="mb-0 text-black">{{$fre->gross_yield}}%</p>
                  </div>
                  @endif
            </div>
        </div>
    </div>
        
    @endforeach
</div>