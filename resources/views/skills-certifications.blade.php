@extends('frontend_layouts.app')
@section('title', 'Skills & Certifications')
@section('content')
{{-- Banner Section --}}
@section('mainBannerTitle', 'Skillset &')
@section('seconderyBannerTitle', 'Certifications')
@include('frontend_layouts.banner')
<!-- Content -->
<div class="container mt-5">
  <div class="row">
    <!-- Skillset -->
    <div class="col-md-4">
      <div class="nes-container is-dark with-title">
        <p class="title">Skilled In</p>
        <div class="lists">
          <ul class="is-disc">
              @foreach ($getSkillsList as $skill)
                <li>{{$skill->skill}}</li>
              @endforeach
          </ul>
        </div>
      </div>
    </div>
    <!-- Certifications -->
    <div class="col-md-8">
      <div class="nes-container with-title">
        <p class="title">Certifications</p>
        <div class="row">
          <div class="col-12">
            @foreach ($getCertList as $cert)
              <div class="nes-container is-dark">
                <h5>
                  <div class="row">
                    <div class="col-md-12">
                      <img class="bg-white rounded nes-avatar is-large" src="{{ asset(mix($cert->certiprovider->provider_logo)) }}">
                    </div>
                    <div class="col-md-12 mt-2">
                      {{$cert->cert_name}}
                    </div>
                    <div class="col-md-12 mt-2">
                      <a href="{{$cert->cert_url}}" target="_blank"> 
                        <i class="nes-icon trophy is-medium"></i>
                      </a>
                    </div>
                  </div>
                </h5>
                <p style="font-size: 0.70rem;" class="mt-3">Date Acquired: {{\Carbon\Carbon::create($cert->acquired_at)->format('Y-m-d')}}</p>
              </div>  
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection