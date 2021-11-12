@extends('frontend_layouts.app')

@section('title', 'Search Results: '.Request::get('post_title'))

@section('content')

<div class="container-fluid">

    {{-- @include('components.notifications') --}}
    @include('blog.components.search-form')

    <div class="container bg-blog-color">
      <div class="row">
          @foreach ($searchResults as $result)
            <div class="col-md-6 col-sm-6 col-xs">
                <div class="box">
                <div class="blog nes-container is-rounded">
                    <img src="/uploads/{{$result->blog_img}}"  class="blog-img" alt="Missing IMG">
                    <hr>
                    <div class="container-blog">
                    <h3>{{$result->title}}</h3>
                    <p style="font-size: 0.80rem;">Published on: {{\Carbon\Carbon::create($result->created_at)->format('Y-m-d')}}</p>
                    <a href="{{route('readPost',$result->id)}}" class="nes-btn">View</a>
                    </div>
                </div>
                <br>
                </div>
            </div>
          @endforeach
      </div>
    </div>

</div>


@endsection