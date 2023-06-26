<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- Font Awesome --}}
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css' integrity='sha512-Z0kTB03S7BU+JFU0nw9mjSBcRnZm2Bvm0tzOX9/OuOuz01XQfOpa0w/N9u6Jf2f1OAdegdIPWZ9nIZZ+keEvBw==' crossorigin='anonymous'/>

        {{-- font --}}
        <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        @vite(['resources/scss/appGuest.scss', 'resources/js/appGuest.js'])
    </head>
    <body>
        <main>

            @include('guest.partials.header')

            @yield('content')

        </main>
    </body>
</html>
