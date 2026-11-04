<section class="pt-8 pb-8">
   <div class="container">
      <div>
         @if($testimonial_count < 1)
            <h2 class="fs-15 text-dark mb-0">Sorry! No Data available</h2>
         @endif
      </div>
      @forelse ($testimonials as $testimonial)
         <div class="media p-4 border rounded-lg shadow-hover-1 pr-lg-8 mb-6 flex-column flex-lg-row no-gutters" data-animate="fadeInUp">
            <div class="col-lg-2 mr-lg-5 card border-0">
               @if(isset($testimonial->image))
                  <img src="{{ asset("storage/$testimonial->image") }}" class="testimonial-img wh-80" alt="{{$testimonial->name}}">
               @else
                  <img src="{{ asset('assets/frontend/img/testimonials/user.png') }}" class="testimonial-img wh-80" alt="{{$testimonial->name}}">
               @endif
            </div>
            <div class="media-body mt-8 mt-lg-0">
               <h2 class="my-0">
                  <p class="fs-16 lh-2 text-dark hover-primary d-block">{{$testimonial->name}}</p>
               </h2>
               
               <p class="mb-2 font-weight-500 text-gray-light">{{$testimonial->city}}</p>
               <p class="mb-0 ml-0"> <i class="fa fa-quote-left text-primary"></i> {!! \App\Support\Html::clean($testimonial->testimonial) !!} <i class="fa fa-quote-right text-primary"></i></p>
               
            </div>
         </div>
      @empty
         
      @endforelse
      
      @if($testimonial_count > 0)
         {{ $testimonials->links() }}
      @endif
   </div>
</section>