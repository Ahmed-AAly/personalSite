@extends('frontend_layouts.app')
@section('title', 'Home')
@section('content')
<!-- Banner Section  -->
@section('mainBannerTitle', 'Hi There!')
@section('seconderyBannerTitle', 'How are you doing today?')
@include('frontend_layouts.banner')
<!-- About Me -->
<div class="container" style="margin-top: 70px;">
  <div class="nes-container is-dark">
    <div class="row d-flex justify-content-center box-img">
      <div class="col-xs">
        <div class="box">
            <img src="@isset($getBiography)/uploads/{{$getBiography->image}}@endisset" class="is-rounded is-large personal-img" alt="Missing asset! :(">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="is-dark with-title is-centered bio-custom">
              <p class="title">Who Am i?</p>
                @isset($getBiography){!! $getBiography->biography !!}@endisset
                <a href="https://www.linkedin.com/in/ahmed-ali-814582a0/" target="_blank"><i class="nes-icon linkedin is-medium"></i></a>
                <a href="https://github.com/Ahmed-AAly" target="_blank"><i class="nes-icon github is-medium"></i></a>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection