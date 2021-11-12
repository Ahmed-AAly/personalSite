@extends('layouts.app')
@section('title', 'Certifications')
@section('content')


<div class="container shadow p-3 mb-5 bg-white">

    @include('components.notifications')

    <div>
        <div>
            <div>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#certiModal">Add</button>

                @isset($getCertiList)
                    
                    {{-- skills table commponent --}}
                
                    @include('components.certifi-table')

                @endisset
            
            </div>
        </div>
        <form id="removeCert-Form" action="{{ route('destroyCertificate') }}" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
            <input type="text" value="" name="cert_ID" id="cert-ID">
        </form>
    </div>
        
</div>

@include('components.certificate-modal')

@endsection
