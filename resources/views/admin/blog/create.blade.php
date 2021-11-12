@extends('layouts.app')
@section('title', 'Create blog post')
@section('content')


<div class="container shadow p-3 mb-5 bg-white">

    @include('components.notifications')

    <div>
        <div>
            <div>
   
                @include('components.blog-create-form')
            
            </div>
        </div>
        {{-- <form id="removeCert-Form" action="{{ route('destroyCertificate') }}" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
            <input type="text" value="" name="cert_ID" id="cert-ID">
        </form> --}}
    </div>
        
</div>

{{-- @include('components.blog-modal') --}}

@endsection