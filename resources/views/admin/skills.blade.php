@extends('layouts.app')
@section('title', 'Skills')
@section('content')


<div class="container shadow p-3 mb-5 bg-white">

    @include('components.notifications')

    <div>
        <div>
            <div>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#skillModal" data-whatever="@mdo">Add</button>

                @isset($getSkillsList)
                    
                    {{-- skills table commponent --}}
                
                    @include('components.skill-table')

                @endisset
            
            </div>
        </div>
        <form id="removeSkill-Form" action="{{ route('destroySkill') }}" method="POST" style="display: none;">
            @method('DELETE')
            @csrf
            <input type="text" value="" name="skill_ID" id="skillID">
        </form>
    </div>
        
</div>

@include('components.skills-modal')

@endsection
