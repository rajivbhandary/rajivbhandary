<div class="pb-8 px-6 pt-6 bg-white rounded-lg">

    <img src="{{asset("storage/{$blog->image}")}}" alt="{{$blog->title}}"    class="rounded-lg d-block">

    @foreach ($blog->tags as $tag)
        <a href="{{ route("frontend.blogs.tag", $tag->slug)}}" class="badge text-white bg-dark-opacity-04 fs-13 font-weight-500 bg-hover-primary hover-white mt-4 mr-2 letter-spacing-1">{{$tag->name}}</a>
    @endforeach
    <ul class="list-inline mt-4">
        <li class="list-inline-item mr-4"><img class="mr-1 rounded-circle" src="{{asset("storage/{$blog->author->image}")}}" alt="Mansi Pujara" width="32px" height="32px"> {{$blog->author->name}}
        </li>
        <li class="list-inline-item mr-4"><i class="fa fa-calendar mr-1"></i>{{explode(' ', $blog->published_at)[0]}}</li>
        <li class="list-inline-item mr-4"><i class="fa fa-eye mr-1"></i> {{$blog->visitLogs()->distinct('ip')->count('ip')}}</li>
    </ul>

    <h3 class="fs-md-32 text-heading lh-141 mb-2">{{$blog->title}}</h3>

    {!! $blog->body !!}
</div>