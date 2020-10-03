@extends('layouts/app_blank_japanese')
@section('header')

@endsection
@section('content')


    <div class="text-center">

        <h2>Lesson 1</h2>
        <audio controls id="audio-repeat">
            <source src="/storage/audio_listen_sensei/L01-01.MP3" type="audio/mpeg"
                    id="audio-repeat-source">
            Your browser does not support the audio element.
        </audio>
        <h2>Lesson 2</h2>
        <audio controls id="audio-repeat">
            <source src="/storage/audio_listen_sensei/L02-01.MP3" type="audio/mpeg"
                    id="audio-repeat-source">
            Your browser does not support the audio element.
        </audio>
        <h2>Lesson 3</h2>
        <audio controls id="audio-repeat">
            <source src="/storage/audio_listen_sensei/L3-01.MP3" type="audio/mpeg"
                    id="audio-repeat-source">
            Your browser does not support the audio element.
        </audio>
        <h2>Lesson 4</h2>
        <audio controls id="audio-repeat">
            <source src="/storage/audio_listen_sensei/L4-1.MP3" type="audio/mpeg"
                    id="audio-repeat-source">
            Your browser does not support the audio element.
        </audio>
    </div>
@endsection
@section('footer')

@endsection
