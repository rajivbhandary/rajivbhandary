<section class="pt-8 pb-8">
        <div class="container">
            <div class="position-relative z-index-2 mb-8">
                <div class="position-relative">
                    <input class="search-field" type="hidden" name="status" value="blog-search" data-default-value="">
                    <form class="d-flex">
                        <div class="position-relative w-100"> <i class="fa fa-search text-dark fs-18 position-absolute pl-4 pos-fixed-left-center"></i>
                            <input type="search" class="rounded-bottom-right-lg w-100 pl-8 py-4 bg-white border fs-13 font-weight-500 text-gray-light rounded-0 lh-17" placeholder="Search..." name="search" value="{{ request('search') }}" aria-label="Search"> </div>
                        <button class="btn btn-primary fs-16 font-weight-600 rounded-left-0 rounded-lg"> Search </button>
                    </form>
                    </div>         
            </div>
            <div>
                @if($blog_count < 1)
                  <h2 class="fs-15 text-dark mb-5">Sorry! No Data available</h2>
               @else
                  <h2 class="fs-15 text-dark mb-5">We found <span class="text-primary">{{$blog_count}}</span> properties available for you
               @endif
            
            </div>
            <div class="row">
                @forelse($blogs as $blog)
                <!-- Single Article -->
                <div class="col-md-4 mb-6">
                    <div class="card border-0 shadow-xxs-3">
                    <div class="position-relative d-flex align-items-end card-img-top">
                        <a href="{{ route('frontend.single-blog', $blog->slug) }}" class="hover-shine">
                        <img src="{{asset("storage/{$blog->image}")}}" width="100%" alt="{{ $blog->title }}">
                        </a>
                    </div>
                    <div class="card-body px-5 pt-3 pb-5">
                        <h3 class="fs-18 text-heading lh-194 mb-1">
                            <a href="{{  route('frontend.single-blog', $blog->slug) }}" class="text-heading hover-primary">{{ $blog->title }}</a>
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

                @empty
         
                @endforelse
            </div>

            @if($blogs->count() > 0)
                {{ $blogs->appends(['search' => request('search')])->links() }}
            @endif

        </div>
    </section>