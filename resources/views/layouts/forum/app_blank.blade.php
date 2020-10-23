<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--<title>{{ config('app.name', 'Tool UML - Lampart') }}</title>--}}
    <title>Tool UML</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="/lib/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @yield('header')
</head>
<body>
<div id="app">
    <main class="py-4">
        <div class="row">

            <div class="col-10" id="wrap-bottom">
                <div class='row'>
                    <div class='col-12'>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<div class="text-center mt-2 mb-5" style="color:#ccc">Copyright © 2019 . All Rights Reserved.</div>
<script src="/js/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
@yield('footer')

</body>
</html>
