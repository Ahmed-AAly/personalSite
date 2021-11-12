@extends('frontend_layouts.app')

@section('title', 'Article: '.$blogPost['0']['title'])

@section('content')
 
<div class="container">
    <div class="row" id="blog-post-continer">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="nes-container is-rounded is-dark is-centered">
            <img src="/uploads/{{$blogPost['0']['blog_img']}}" class="blog-post-view-img" alt="">
            <div class="" style="text-align: left;">
              <hr>
              <h3 id="blog-title">{{$blogPost['0']['title']}}</h3>
              <hr>
              {{-- <p id="blog-content" style="">{!!$blogPost['0']['blog_content']!!}</p> --}}
              <div id="blog-content">
                {!!$blogPost['0']['blog_content']!!}
              </div>
              <br>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection