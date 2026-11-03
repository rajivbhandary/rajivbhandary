<div class="col-md-3">
    <div class="content-blog-left">
        <div class="search-blog">
            <form action="{{ route("blogs.preview") }}">
                <input type="text" name="search" class="float-left" placeholder="Search"
                       value="{{ request('search') }}">
                <button type="submit" class="btn blog-details-btn">
                    <span class="lnr lnr-chevron-right"></span>
                </button>
            </form>
        </div>
        <div class="lastest-blog">
            <h2>Latest Posts</h2>
            @foreach($latest_blogs as $blog)
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-xl-4 col-lg-5 col-md-12 col-sm-6 col-6">
                            <div class="img-lastest-blog">
                                <img src="{{ asset("storage/$blog->image") }}" class="card-img"
                                     alt="...">
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-12 col-sm-6 col-6">
                            <div class="card-body">
                                <p class="card-text">{{ $blog->published_date }}</p>
                                <span class="card-text"><a href="{{ route("blogs.single-blog-preview", $blog->slug) }}">{{ $blog->title }}</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
