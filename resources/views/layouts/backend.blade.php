<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://img.icons8.com/material/4ac144/256/user-male.png" type="image/x-icon"> 
    <title>{{$title ?? 'Desa Maja'}}</title>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->
    @yield('styles')
    <livewire:styles>
</head>
<body>
    <div id="wrapper">
        <div class="wrapper">
            <x-navigations.sidenav></x-navigations.sidenav>
            <div class="main">
                @include('layouts.component.topnav')
                @yield('content')
                @include('layouts.component.footer')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @stack('scripts')
    <livewire:scripts>
</body>
</html>
