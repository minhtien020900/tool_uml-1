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
    @include("plantuml/navbar")
    <main class="py-4">
        <div class="row">
            <div class='col-2' id='wrap-top'>
                @if(Route::current()->getName()!= 'plantuml.byuser')
                    <div class="mb-3" id="list-project">
                        <ul>
                            @foreach($projects as $p)
                                <li>
                                    <a href="{{route('project.show',$p->id."-".$p->name)}}"
                                       class="{{Session::get('current_projectI')['id'] === $p->id ?'active':''}}">
                                        {{$p->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
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
<div class="text-center mt-2 mb-5" style="color:#ccc">Copyright © 2019 Team Chí. All Rights Reserved.</div>
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
