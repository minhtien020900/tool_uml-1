@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center">
        <h2>404</h2>
        <div>{!! session('error') !!}</div>
    </div>
</div>
@endsection
