@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container shadow p-3 mb-5 bg-white">
    <script>
        const msgTRend =  {!! json_encode($monthlyMessagesTrend, JSON_HEX_TAG) !!};
        const convertObjectToArray = Object.keys(msgTRend).map((key) => [String(key), msgTRend[key]]);
        const topFiveContacts =  {!! json_encode($top5Contact, JSON_HEX_TAG) !!};
        const topFiveContactsArray = Object.keys(topFiveContacts).map((key) => [String(key), topFiveContacts[key]]);
    </script>
    @include('components.notifications')

    <div class="row justify-content-center ">
        <div class="col-md-7 shadow p-3 mb-5 bg-white rounded mr-1">
            <canvas id="myChart" width="300" height="150"></canvas>
        </div>
        <div class="col-md-4 shadow p-3 mb-5 bg-white rounded">
            <canvas id="myChart2" width="150" height="150"></canvas>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Latest Messages</div>

                <div class="card-body table-responsive">
                    @include('components.contactmessges')
                </div>
                <form id="removeMSG-Form" action="{{ route('destroyMessage') }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                    <input type="text" value="" name="meg_id" id="msgID">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
