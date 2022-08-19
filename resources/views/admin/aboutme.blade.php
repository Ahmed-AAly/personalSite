@extends('layouts.app')
@section('title', 'My Biography')
@section('content')

<div class="container shadow p-3 mb-5 bg-white">
    @include('components.notifications')
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('updateBiography')}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" name="id" value="@isset($biography){{$biography->id}}@endisset" hidden>
                        <label for="inputEmail4">Personal Image:</label>
                        <img width="50%" src="@isset($biography)/uploads/{{$biography->image}}@endisset" 
                        height="auto" class="rounded w-25 mb-2 card" alt="Nothing TO Display">
                        <input type="file" name="mypic" class="form-control-file mt-2" id="inputEmail4" >
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword4">Biography:</label>
                        <textarea name="story" id="customTextEditor">@isset($biography){{$biography->biography}}@endisset</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

    
