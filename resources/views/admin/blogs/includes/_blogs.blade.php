<!-- Blog -->
<section class="blog-area">
    <div class="container">
        <div class="section-title @yield('blog-area-section-style', "pt-100")">
            <h2>@yield('blog-area-heading', "More About Wills")</h2>
        </div>
        <div class="blog-slider owl-theme owl-carousel">
            @foreach($blogs as $blog)
                <div class="blog-item">
                    <a href="{{ route('blogs.single-blog-preview', $blog->slug) }}">
                        @if($blog->image)
                            <img src="{{ asset("storage/$blog->cover") }}" alt="Blog">
                        @endif
                    </a>
                    <div class="blog-inner">

                        <h3>
                            <a href="{{ route("blogs.single-blog-preview", $blog->slug) }}">{{ $blog->title }}</a>
                        </h3>
                        <ul>
                            <li>
                                <i class="icofont-calendar"></i>
                                {{ $blog->published_date }}
                            </li>
                            <li>
                                <i class="icofont-user-alt-7"></i>
                                <a href="#">{{ $blog->author->name }}</a>
                            </li>
                        </ul>
                        <p>{{ $blog->truncated_excerpt }}</p>
                        <a class="blog-link" href="{{ route("blogs.single-blog-preview", $blog->slug) }}">
                            Read More
                            <i class="icofont-simple-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Blog -->
