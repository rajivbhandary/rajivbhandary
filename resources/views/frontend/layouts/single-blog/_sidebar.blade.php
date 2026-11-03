                    <div class="pb-8 px-6 pt-6 bg-white rounded-lg">    
                        <input class="search-field" type="hidden" name="status" value="blog-search" data-default-value="">
                        <form class="d-flex mb-4" action="#">
                                <div class="position-relative w-100"> <i class="fa fa-search text-dark fs-18 position-absolute pl-4 pos-fixed-left-center"></i>
                                    <input type="text" class="rounded-bottom-right-lg pl-8 py-2 w-100 bg-white border fs-13 font-weight-500 text-gray-light rounded-0 lh-17" placeholder="Search..." name="search-blog"> 
                                </div>
                        </form>
                        <h4 class="fs-22 text-heading mb-3">Similar Blogs</h4>
                        @for ($i=1; $i< 3; $i++)
                            <div class="card border-0 shadow-xxs-3 mt-4">
                                <div class="position-relative d-flex align-items-end card-img-top">
                                    <a href="{{route('frontend.single-blog', $blogs[$i]->slug)}}" class="hover-shine">
                                    <img src="{{asset("storage/{$blogs[$i]->image}")}}" alt="{{$blogs[$i]->title}}">
                                    </a>
                                </div>
                                <div class="card-body px-5 pt-3 pb-5">
                                    <h3 class="fs-18 text-heading lh-194 mb-1">
                                    <a href="{{route('frontend.single-blog', $blogs[$i]->slug)}}" class="text-heading hover-primary">{{$blogs[$i]->title}}</a>
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
                        

                        <div class="card border-0 shadow-xxs-3 mt-4">
                            <div class="card-body px-6 py-5">
                                <h4 class="card-title fs-16 lh-2 text-dark mb-3">Popular Tags</h4>
                                <ul class="list-inline mb-0">
                                    @foreach ($tags as $tag)
                                        <li class="list-inline-item mb-2">
                                            <a href="{{route('frontend.blogs.tag', $tag->slug)}}" class="px-2 py-1 d-block fs-13 lh-17 bg-gray-03 text-muted hover-white bg-hover-primary rounded">{{$tag->name}}</a>
                                        </li>
                                    @endforeach                                    
                                </ul>
                            </div>
                        </div>
                    </div>