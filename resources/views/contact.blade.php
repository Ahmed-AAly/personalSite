@extends('frontend_layouts.app')
@section('title', 'Contact')
@section('content')
{{-- Banner Section --}}
@section('mainBannerTitle', __('backendLang.homebanner5'))
@section('seconderyBannerTitle', __('backendLang.homebanner6'))
@include('frontend_layouts.banner')
<!-- Contact Form -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="nes-container with-title is-dark is-centered">
                <p class="title">Contact</p>
                        @if (session('messageSent'))
                            <span class="nes-text is-success">{{ session('messageSent') }}</span>
                        @endif
                        @if (session('messageFailed'))
                            <span class="nes-text is-error">{{ session('messageFailed') }}</span>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <small id="searchHelpBlock" class="form-text text-muted">
                                <span class="nes-text is-error">{{ $error }}</span>
                            </small>
                            @endforeach
                        @endif
                    <form action="" method="post">
                        @csrf
                        <div class="nes-field is-inline">
                            <label for="inline_field">Name</label>
                            <input type="text" name="name" id="name_field" class="nes-input" placeholder="Your Name" autocomplete="off" required>
                        </div>
                        <div class="nes-field is-inline">
                            <label for="inline_field">Email</label>
                            <input type="email" id="email_field" name="email" class="nes-input" placeholder="Email" autocomplete="off" required>
                        </div>
                        <div class="nes-field">
                            <label for="textarea_field">Message</label>
                            <textarea title="Type your message here" id="message_field" class="nes-textarea" name="message" rows="8" cols="40" autocomplete="off" required></textarea>
                        </div>
                        <button type="submit" class="nes-btn is-success">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection