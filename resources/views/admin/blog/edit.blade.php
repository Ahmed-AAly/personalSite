@extends('layouts.app')
@section('title', 'Edit blog post')
@section('content')


<div class="container shadow p-3 mb-5 bg-white">

    @include('components.notifications')

    <div>
        <div>
            <div>
   
                @include('components.blog-edit-form')
            
            </div>
        </div>
    </div>
        
</div>

{{-- @include('components.blog-modal') --}}

@endsection