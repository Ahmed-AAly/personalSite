<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Personal Website">
        <meta name="keywords" content="Personalsite, Moodle, PHP, SQL, Elearning, Laravel, Jquery, MySQL">
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
        <title>Maintenance Page</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/nes.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/custom.css')) }}">
        <!-- Scripts -->
        <script src="{{ asset(mix('js/app.js')) }}" defer></script>
    </head>
    <body class="font-class2">
        <main>
            <div class="container" style="margin-top: 200px;">
                <div class="row justify-content-md-center">
                    <div class="col-md-8">
                     <div class="nes-container with-title is-dark is-centered">
                         <p class="title">Sorry, this website is down for maintenance</p>
                         <i class="nes-kirby"></i>
                         <p>People of earth we are currently doing quick system maintenance and updates, we will be back ASAP</p>
                       </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>