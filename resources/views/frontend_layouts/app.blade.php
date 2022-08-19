<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Personal Website">
        <meta name="keywords" content="Personalsite, Moodle, PHP, SQL, Elearning, Laravel, Jquery, MySQL, Moodle Plugin Development, Moodle Adminstration">
        <meta name="author" content="Ahmed Ali">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(mix('img/apple-touch-icon.png')) }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(mix('img/favicon-32x32.png')) }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(mix('img/favicon-16x16.png')) }}">
        <link rel="manifest" href="{{ asset(mix('img/site.webmanifest')) }}">
        <link rel="mask-icon" href="{{ asset(mix('img/safari-pinned-tab.svg')) }}" color="#5bbad5">
        <link rel="shortcut icon" href="{{ asset(mix('img/favicon.ico')) }}" type='image/x-icon'>
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="{{ asset(mix('img/browserconfig.xml')) }}">
        <meta name="theme-color" content="#ffffff">
        <title>@yield('title')</title>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/nes.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/custom.css')) }}">
        <!-- Scripts -->
        <script src="{{ asset(mix('js/app.js')) }}" defer></script>
    </head>
    <body class="font-class2">
        <button onclick="topFunction()" class="nes-btn is-small is-error" id="myBtn" title="Go to top">up</button>
        <div>
            @include('frontend_layouts.header')
            @include('frontend_layouts.navbar')
            @show
            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
    <script>
        //Get the button
        const bkToTopBtn = document.getElementById("myBtn");
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};
        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            bkToTopBtn.style.display = "block";
          } else {
            bkToTopBtn.style.display = "none";
          }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            document.documentElement.scrollTop = 0;
        }
    </script>
    {{-- Page Footer --}}
    @include('frontend_layouts.footer')
</html>