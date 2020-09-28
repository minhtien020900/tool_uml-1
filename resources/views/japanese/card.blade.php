@extends('layouts/app_blank_japanese')
@section('header')
<style>
    #card{
        text-align: center;
    }
    .text{
        font-weight: bold;
        font-size: 30px;
    }
</style>
@endsection
@section('content')
    <div id="app-card">
        <div id="card">
            <div class=" d-none all"></div>
            <div class="text"></div>
            <div class="meaning"></div>
        </div>
    </div>
@endsection
@section('footer')
    <script>

        var vocalist = [];
        $(document).ready(() => {
            $.get("/api/card?l=2", function (data) {
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
            $('#card .all').text(JSON.stringify(d));
        }

        function play() {
            displayCard(vocalist[0])
        }
        var i = 0
        $(document).ready(function() {
            $(this).keydown(function(e) {
                // phải
                console.log(e.keyCode);
                if(e.keyCode === 39){
                    if( i > vocalist.length){
                        i=0;
                    }
                    i++;
                    displayCard(vocalist[i]);
                    console.log(i);

                }
                // trái
                if(e.keyCode === 37){
                    if (i < 0) {
                        i = vocalist.length-1;
                    }
                    i--;
                    displayCard(vocalist[i]);
                    console.log(i);

                }
                // if(e.keyCode === 18) { alt_shifter = true; $('.access_key').css({ textDecoration: 'underline' }); }
            });


        });
    </script>
@endsection
