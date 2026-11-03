<section class="bg-gray-02 pt-8 pb-8" data-animated-id="6">
    <div class="container">
        <p class="text-primary letter-spacing-263 text-uppercase lh-186 text-center mb-0">testimonials</p>
        <h2 class="text-center lh-1625 text-dark mb-2">What Our Clients Say About Us</h2>
            <div id="testimonial-items" class="testimonials slick-slider" data-slick-options='{"slidesToShow": 1, "autoplay":true,"dots":true,"responsive":[{"breakpoint": 1600,"settings": {"slidesToShow":1,"arrows":false}},{"breakpoint": 992,"settings": {"slidesToShow":1,"arrows":false}},{"breakpoint": 768,"settings": {"slidesToShow": 1,"arrows":false,"dots":true,"autoplay":true}},{"breakpoint": 576,"settings": {"slidesToShow": 1,"arrows":false,"dots":true,"autoplay":true}}]}'>
                
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-item">
                        <div class="bg-gray-02 card p-6 border-0 fadeInUp animated mb-0" data-animate="fadeInUp">
                            <div class="card-body p-0 text-center"> <span class="text-primary fs-26 lh-1 mb-4 d-block"><i class="fa fa-quote-left"></i></span>
                                <p class="card-text fs-15 lh-2 mb-4">{!!$testimonial->testimonial!!}</p> <span class="mx-auto divider mb-5"></span> <img src="{{ asset("storage/$testimonial->image") }}" class="testimonial-img rounded-circle d-inline-block mb-2" alt="Testimonial Image">
                                <p class="fs-16 lh-214 text-dark font-weight-500 mb-0">{{$testimonial->name}}</p>
                                <p class="mb-0">{{$testimonial->city}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
</section>