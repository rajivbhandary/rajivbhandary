<section class="pt-8 pb-8">
   <div class="container">
      <p class="text-primary letter-spacing-263 text-uppercase lh-186 text-center mb-0">new & articles</p>
      <h2 class="text-center lh-1625 text-dark pb-1">
         Check Out Recent Blogs
      </h2>
      <div class="mx-n2">
         <div id="blogs" class="slick-slider" data-slick-options='{"slidesToShow": 4, "autoplay":true,"dots":true,"responsive":[{"breakpoint": 1600,"settings": {"slidesToShow":3,"arrows":false}},{"breakpoint": 992,"settings": {"slidesToShow":2,"arrows":false}},{"breakpoint": 768,"settings": {"slidesToShow": 2,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 576,"settings": {"slidesToShow": 1,"arrows":false,"dots":true,"autoplay":true}}]}'>
            @foreach($blogs as $blog)
               <!-- Single Article -->
               <div class="item py-4 m-1" data-animate="fadeInUp">
                  <div class="card border-0 shadow-xxs-3">
                     <div class="position-relative d-flex align-items-end card-img-top">
                        <a href="{{ route('frontend.single-blog', $blog->slug) }}" class="hover-shine">
                        <img src="{{asset("storage/{$blog->image}")}}" alt="{{$blog->title}}">
                        </a>
                     </div>
                     <div class="card-body px-5 pt-3 pb-5">
                        <h3 class="fs-18 text-heading lh-194 mb-1">
                           <a href="{{ route('frontend.single-blog', $blog->slug) }}" class="text-heading hover-primary">{{$blog->title}}</a>
                        </h3>
                        <div class="d-flex justify-content-between text-gray align-items-center">
                           <div>{{ $blog->author->name }}</div>    
                           <div>{{ explode(' ', $blog->published_at)[0] }}</div>                                      
                        </div>
                        <p class="mb-3 text-gray">{{ $blog->excerpt }}</p>
                        <a class="text-heading font-weight-500" href="{{ route('frontend.single-blog', $blog->slug) }}">Learn more <i class=" fa fa-long-arrow-right text-primary ml-1"></i></a>
                     </div>
                  </div>
               </div>

            @endforeach
         </div>
      </div>
   </div>
</section>