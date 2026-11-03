@extends('frontend.layouts.app')

@section('title', 'Blogs | Perks Properties')

@section('seo-author', $config->default_seo_author)

@section('seo-description'){{ $blog->seo_description ?? $config->default_seo_description }}@endsection

@section('seo-keywords'){{ $config->default_seo_keywords . ($blog->seo_keywords ? ", $blog->seo_keywords" : '') }}@endsection

@section('seo-og-title'){{ $blog->seo_og_title ?? $config->default_seo_og_title }}@endsection

@section('seo-og-description'){{ $blog->seo_og_description ?? $config->default_seo_og_description }}@endsection

@section('title'){{ "$blog->title | Perks Properties" }}@endsection

@section('main-content')
    <!-- ============================ Agency List Start ================================== -->
    <div id="property-list-hero-section" class="text-center bg-cover mb-10" data-animated-id="2">
        <div class="hero-section-overlay">
            <div class="container py-15 ">
                <div data-animate="fadeInDown" class="fadeInDown animated">
                <h2 class="fs-md-42 text-white pt-5"><span class="fs-md-52 font-weight-bold text-white pt-2 d-block">
                {{$blog->title}}
                </span>
                </h2>
                    <p class="lead font-weight-light"><a href="{{route('frontend.index')}}" class="text-gray">Home</a>&nbsp;/&nbsp;<a href="{{ route('blogs.preview')}}" class="text-gray">Blogs</a>&nbsp;/
                    <a href="{{ route('blogs.preview', $blog->slug)}}" class="text-white">{{$blog->title}}</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="primary-content bg-gray-01 pt-7 pb-12" data-animated-id="3">
        <div class="container">
            <div class="row">
                <article class="col-lg-8">
                    <!-- Description -->
                    <div class="pb-8 px-6 pt-6 bg-white rounded-lg">

                        <img src="{{asset("storage/{$blog->image}")}}" alt="{{$blog->title}}" class="rounded-lg d-block">

                        @foreach ($blog->tags as $tag)
                            <a href="route{{ route("blogs.preview.tag", $tag->slug)}}" class="badge text-white bg-dark-opacity-04 fs-13 font-weight-500 bg-hover-primary hover-white mt-4 mr-2 letter-spacing-1">{{$tag->name}}</a>
                        @endforeach
                        <ul class="list-inline mt-4">
                            <li class="list-inline-item mr-4"><img class="mr-1 rounded-circle" src="{{asset("storage/{$blog->author->image}")}}" alt="Mansi Pujara" width="32px" height="32px">
                            {{$blog->author->name}}</li>
                            <li class="list-inline-item mr-4"><i class="fa fa-calendar mr-1"></i>{{explode(' ', $blog->published_at)[0]}}</li>
                            <li class="list-inline-item mr-4"><i class="fa fa-eye mr-1"></i> {{$blog->visitLogs()->distinct('ip')->count('ip')}}</li>
                        </ul>

                        <h3 class="fs-md-32 text-heading lh-141 mb-2">{{$blog->title}}</h3>

                        {!! $blog->body !!}
                    </div>
                </article>

                <aside class="col-lg-4 pl-xl-4 primary-sidebar sidebar-sticky" id="sidebar">
                    <!-- sidebar-->
                    <div class="pb-8 px-6 pt-6 bg-white rounded-lg">
                        <input class="search-field" type="hidden" name="status" value="blog-search" data-default-value="">
                        <form class="d-flex mb-4" action="#">
                                <div class="position-relative w-100"> <i class="fa fa-search text-dark fs-18 position-absolute pl-4 pos-fixed-left-center"></i>
                                    <input type="text" class="rounded-bottom-right-lg pl-8 py-2 w-100 bg-white border fs-13 font-weight-500 text-gray-light rounded-0 lh-17" placeholder="Search..." name="search-blog"> 
                                </div>
                        </form>
                        <h4 class="fs-22 text-heading">Similar Blogs</h4>
                        @for ($i=1; $i< 3; $i++)
                            <div class="card border-0 shadow-xxs-3 mt-4">
                                <div class="position-relative d-flex align-items-end card-img-top">
                                    <a href="{{route('blogs.single-blog-preview', $blogs[$i]->slug)}}" class="hover-shine">
                                    <img src="{{asset("storage/{$blogs[$i]->image}")}}" alt="{{$blogs[$i]->title}}">
                                    </a>
                                </div>
                                <div class="card-body px-5 pt-3 pb-5">
                                    <h3 class="fs-18 text-heading lh-194 mb-1">
                                    <a href="{{route('blogs.single-blog-preview', $blogs[$i]->slug)}}" class="text-heading hover-primary">{{$blogs[$i]->title}}</a>
                                    </h3>
                                    <div class="d-flex justify-content-between text-gray align-items-center">
                                    <div>{{$blogs[$i]->author->name}}</div>    
                                    <div>{{explode(' ', $blogs[$i]->published_at)[0]}}</div>                                      
                                    </div>
                                    <p class="mb-3 text-gray">{{$blogs[$i]->excerpt}}</p>
                                    <a class="text-heading font-weight-500" href="blog-details-1.html">Learn more <i class=" fa fa-long-arrow-right text-primary ml-1"></i></a>
                                </div>
                            </div> 
                        @endfor
                        

                        <div class="card border-0 shadow-xxs-3 mt-4 mb-4">
                            <div class="card-body px-6 py-5">
                                <h4 class="card-title fs-16 lh-2 text-dark mb-3">Popular Tags</h4>
                                <ul class="list-inline mb-0">
                                    @foreach ($tags as $tag)
                                        <li class="list-inline-item mb-2">
                                            <a href="{{route('blogs.preview.tag', $tag->slug)}}" class="px-2 py-1 d-block fs-13 lh-17 bg-gray-03 text-muted hover-white bg-hover-primary rounded">{{$tag->name}}</a>
                                        </li>
                                    @endforeach                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
        	</div>
        </div>
    </div>
    
    <!-- ============================ Agency List End ================================== -->
@endsection

@section('scripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ef4dc15607eaeaf"></script>

@endsection
