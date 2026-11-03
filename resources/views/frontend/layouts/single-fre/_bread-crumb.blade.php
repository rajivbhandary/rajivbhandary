<div id="property-list-hero-section" class="text-center bg-cover" data-animated-id="2">
        <div class="hero-section-overlay">
            <div class="container py-15 ">
                <div data-animate="fadeInDown" class="fadeInDown animated">
                <h2 class="fs-md-42 text-white pt-5"><span class="fs-md-52 font-weight-bold text-white pt-2 d-block">
                    {{$fre->title}}
                </span>
                </h2>
                    <p class="lead font-weight-light"><a href="{{route('frontend.index')}}" class="text-gray">Home&nbsp;/</a> <a href="{{ route('frontend.fre')}}" class="text-gray">FREs&nbsp;/</a> 
                    <a href="{{ route('frontend.single-fre', $fre->slug) }}" class="text-white">{{$fre->title}}</a></p>
                </div>
            </div>
        </div>
    </div>