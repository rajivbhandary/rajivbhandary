<section class="pt-8 pb-8">
   <div class="container">
      <div class="container">
         <div class="row align-items-sm-center" data-animate="fadeInUp">
            <div class="col-md-6 pb-8">
               @if($fre_count < 1)
                  <h2 class="fs-15 text-dark mb-0">Sorry! No Data available</h2>
               @else
                  <h2 class="fs-15 text-dark mb-0">We found <span class="text-primary">{{$fre_count}}</span> projects available for you
               @endif
               </h2>
            </div>
         </div>
      </div>
      @forelse ($fres as $fre)
         <div class="media p-4 border rounded-lg shadow-hover-1 pr-lg-8 mb-6 flex-column flex-lg-row no-gutters" data-animate="fadeInUp">
            <div class="col-lg-4 mr-lg-5 card border-0 hover-change-image bg-hover-overlay">
            <img src="{{asset("storage/{$fre->feature_image_path}")}}" class="card-img" alt="{{$fre->title}}">
            <div class="card-img-overlay p-2 d-flex flex-column">
                  <div class="mt-auto d-flex hover-image">
                     <ul class="list-inline mb-0 d-flex align-items-end mr-auto">
                        <li class="list-inline-item mr-2" data-toggle="tooltip" title="9 Images">
                           <a href="{{ route('frontend.single-fre', $fre->slug) }}" class="text-white hover-primary"> <i class="fa fa-image"></i><span class="pl-1">{{ $fre->image->count() }}</span> </a>
                        </li>
                     </ul>
                  </div>
               </div>
            <a href="{{ route('frontend.single-fre', $fre->slug) }}" class="stretched-link"></a>
            </div>
            <div class="media-body mt-5 mt-lg-0">
               <div class="row">
                  <div class="col-md-6">
                  <h2 class="my-0">
                     <a href="{{ route('frontend.single-fre', $fre->slug) }}" class="fs-16 lh-2 text-dark hover-primary d-block">{{$fre->title}}</a>
                  </h2>
                  </div>
                  <div class="col-md-6">
                     <div class="d-lg-flex justify-content-end">
                        <a href="#" data-toggle="modal" data-target="#enquiryModal" data-model="fre" data-id="{{ $fre->id }}" class="btn btn-primary enquiry-button">Enquire Now</a>
                     </div>
                  </div>
               </div>
               @if($fre->rental_yield != null)
               <p class="mxw-571 ml-0">Get total Annual Returns of {{$fre->rental_yield}}% with {{$fre->developer->name}}</p>
               @endif
               <p class="mxw-571 ml-0 text-gray-light pb-1">Listed by {{$fre->developer->name}}</p>
               <div class="row pb-1">
                  <div class="col-md-3">
                     {{$fre->built_up_area}} sq.ft
                  </div>
                  <div class="pl-3">
                     <div class="d-lg-flex justify-content-center">
                       {{$fre->location->locality}}, {{$fre->location->town}}, {{$fre->location->city}}
                     </div>
                  </div>
               </div>
               <p class="ml-0">{{$fre->overview}}</p>

               <div class="row">
                  <div class="col-sm-3 mb-0">
                     <p class="mb-0 text-gray">Commercial Space</p>
                     <p class="mb-0 text-black">{{$fre->commercial_space}}</p>
                  </div>
                  <div class="col-sm-3 mb-0">
                     <p class="mb-0 text-gray">Min. Investment</p>
                     <p class="mb-0 text-black">Rs. {{$fre->minimum_investment}}*</p>
                  </div>
                  @if ($fre->rental_yield != null)
                     <div class="col-sm-3 mb-0">
                        <p class="mb-0 text-gray">Avg. Return Yeild</p>
                        <p class="mb-0 text-black">{{$fre->rental_yield}}%</p>
                     </div>
                  @endif
                  @if($fre->gross_yield != null)
                  <div class="col-sm-3 mb-0">
                     <p class="mb-0 text-gray">Gross Yiels</p>
                     <p class="mb-0 text-black">{{$fre->gross_yield}}%</p>
                  </div>
                  @endif
               </div>
            </div>

         </div>
         
         @empty
         
         @endforelse

         @if($fre_count > 0)
            {{ $fres->links() }}
         @endif
   </div>
</section>