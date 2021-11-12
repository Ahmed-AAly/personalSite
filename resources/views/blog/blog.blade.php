@extends('frontend_layouts.app')

@section('title', 'Blog')

@section('content')
 
<div class="container-fluid">

  @include('blog.components.search-form')

  <div class="container bg-blog-color">
    <div class="row">
        @foreach ($blogList as $blog)
          <div class="col-md-6 col-sm-6 col-xs">
              <div class="box">
              <div class="blog nes-container is-rounded">
                  <img src="/uploads/{{$blog->blog_img}}"  class="blog-img" alt="Missing IMG">
                  <hr>
                  <div class="container-blog">
                  <h3>{{$blog->title}}</h3>
                  <p style="font-size: 0.80rem;">Published on: {{\Carbon\Carbon::create($blog->created_at->toDateTimeString())->format('Y-m-d')}}</p>
                  <a href="{{route('readPost',$blog->id)}}" class="nes-btn">View</a>
                  </div>
              </div>
              <br>
              </div>
          </div>
        @endforeach
    </div>
    {{ $blogList->links('vendor.pagination.nes') }}
  </div>
  
</div>


@endsection