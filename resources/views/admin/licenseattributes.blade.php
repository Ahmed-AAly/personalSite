@extends('layouts.app')
@section('title', 'license & Attributes')
@section('content')

<div class="container shadow p-3 mb-5 bg-white">
    @include('components.notifications')
    <div class="row">
        <div class="col-md-12">
            <form enctype="multipart/form-data" action="{{route('updateLicenseAttributes', $licenseDetails->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="h3" for="inputPassword4">license & Attributes:</label>
                        <textarea name="licenseContent" id="customTextEditor">
                            {{ old('licenseContent') }}
                            @isset($licenseDetails)
                            {{$licenseDetails->license_attributes}}
                            @endisset
                        </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection