@extends('layouts.app')
@section('title', 'Blog')
@section('content')


<div class="container shadow p-3 mb-5 bg-white">

    @include('components.notifications')

    <div>
        <div>
            <div>
                
                <a href="{{route('createBlog')}}" class="btn btn-primary" >Create</a>

                @isset($blogList)
                    
                    {{-- skills table commponent --}}
                
                    @include('components.blog-posts')

                @endisset
            
            </div>
        </div>
        <form id="editPost-Form" action="{{ route('editBlog') }}" method="GET" style="display: none;">
            @csrf
            <input type="text" value="" name="post_ID" id="post-ID">
        </form>
    </div>
        
</div>

@include('components.blog-modal')

@endsection
