@extends('layouts/app_blank_japanese')
@section('header')
    <style>
        #card {
            text-align: center;
        }

        .text {
            font-weight: bold;
            font-size: 35px;
        }

        .toolbar-fixed {
            position: fixed;
            bottom: 0px;
            width: 100%;
        }
    </style>
@endsection
@section('content')
    <div id="app-card">
        <div id="card">
            <div class=" d-none all"></div>
            <div class="text"></div>
            <div class="meaning"></div>
            <div class="image"><img src=""></div>
            <hr>

        </div>
        <div class="toolbar-fixed text-center">
            <button class="btn btn-lg btn-primary moveLeft">Left</button>
            <button class="btn btn-lg btn-secondary moveDone">Done</button>
            <button class="btn btn-lg btn-primary moveRight">Right</button>
        </div>
    </div>
    <audio hidden controls id="audio-repeat">
        <source src="http://dev.japanese.oop.vn/storage/japanese_audio/Bai2/9_jishiyo_Tu_dien.mp3" type="audio/mpeg"
                id="audio-repeat-source">
        Your browser does not support the audio element.
    </audio>
@endsection
@section('footer')
    <script>
        $('.moveLeft').on('click', function () {
            moveLeft();
        });
        $('.moveRight').on('click', function () {
            moveRight();
        });
        $('.moveDone').on('click', function () {
            moveDone();
        });
        var vocalist = [];
        $(document).ready(() => {
            $.get("/api/card?l={{$lesson}}", function (data) {
                // let random = vocalist[~~(vocalist.length * Math.random())]
                vocalist = data.sort(function () {
                    return .5 - Math.random();
                });
                play();
            });
        })

        function displayCard(d) {
            $('#card .text').text(d[1]);
            $('#card .meaning').text(d[5]);
            $('#card .meaning').hide();
            $('#card .image img').attr('src', d[6]);

            $('#card .all').text(JSON.stringify(d));

            $("#audio-repeat-source")[0].src = d[7];
            $("#audio-repeat")[0].load();
            $("#audio-repeat")[0].play();

        }

        function play() {
            displayCard(vocalist[0])
        }

        var i = 0

        function moveDone() {
            vocalist = vocalist.filter((k, v) => {
                if (k !== i) {
                    return v;
                }
            })
            console.table(vocalist);
            moveRight();

        }

        function moveRight() {
            if (i > vocalist.length) {
                i = 0;
            }
            i++;
            displayCard(vocalist[i]);
            console.log(i);
        }

        function moveLeft() {
            if (i < 0) {
                i = vocalist.length - 1;
            }
            i--;
            displayCard(vocalist[i]);
            console.log(i);
        }

        $(document).ready(function () {
            $(this).keydown(function (e) {
                // phải
                console.log(e.keyCode);
                if (e.keyCode === 39) {
                    moveRight();
                }
                // trái
                if (e.keyCode === 37) {
                    moveLeft();
                }
                // if(e.keyCode === 18) { alt_shifter = true; $('.access_key').css({ textDecoration: 'underline' }); }
            });


        });
    </script>
@endsection
