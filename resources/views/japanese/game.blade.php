@extends('layouts/app_blank_japanese')
@section('header')
    <style>
        #repeate {
            position: fixed;
            bottom: 0px;
            background: #ccc;
            right: 0px;
            width: 100%;
            text-align: center;
        }

        img {
            cursor: pointer;
        }

        .ele-voca {
            text-align: center;
            float: left;
            width: 200px;
            height: 200px;
            margin: 5px;
            box-shadow: 1px 1px 1px #ccc;
        }

        .ele-voca img {
            max-height: 100%;
            max-width: 100%;
        }

        @media only screen and (max-width: 600px) {
            .ele-voca {
                float: left;
                width: 85px;
                height: 85px;
                margin: 5px;
                box-shadow: 1px 1px 1px #ccc;
            }

            .ele-voca img {
                max-height: 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="">
        <div class="">
            <div class="">
                <div class="col-12">
                    @foreach($vocabularies as $v)
                        <div class="ele-voca" data-id="{!! $v[0] !!}">

                            <img data-id="{!! $v[0] !!}" src="{!! $v[6]??'' !!}">
                            @if(isset($v[7]))
                                <audio hidden controls id="audio_{!! $v[0] !!}" src="{!! $v[7]??'' !!}">
                                    <source src="{!! $v[7]??'' !!}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div id="repeate">
        <audio hidden controls id="audio-repeat">
            <source src="http://dev.japanese.oop.vn/storage/japanese_audio/Bai2/9_jishiyo_Tu_dien.mp3" type="audio/mpeg" id="audio-repeat-source">
            Your browser does not support the audio element.
        </audio>
        <button class="btn btn-primary" @click="repeat()">Repeat</button>
    </div>
@endsection
@section('footer')
    <script>

        $(document).ready()
        {
            var voca = function (v) {

                this.id = $(v).data('id');


                if ($(v).children('img').length > 0) {
                    this.img = $(v).children('img')[0].getAttribute('src');
                } else {
                    this.img = '';
                }

                if ($(v).children('audio').length > 0) {
                    this.audio = $(v).children('audio')[0].getAttribute('src');
                } else {
                    this.audio = '';
                }

            };
            voca.prototype.showss = function () {
            }
            // let m = new voca();
            // m.showss();
            let vocalist = [];
            $(".ele-voca").each((k, v) => {
                vocalist.push(new voca(v));
            });
            var random = vocalist[~~(vocalist.length * Math.random())]
            var flag_success = false;

            $('img').click(function () {

                if($(this).data('id') === random.id){
                    dungroi();
                    flag_success= true;
                    // alert('OK !!! ');
                    // random = vocalist[~~(vocalist.length * Math.random())]
                    // playRandom();
                }else{

                    $('#audio_' + $(this).data('id'))[0].play().then(()=>{})
                }
            });

            $("#repeate button").click(()=>{
                playRandom();
            })

            function playRandom(){


                if(flag_success === true){
                    random = vocalist[~~(vocalist.length * Math.random())]
                    flag_success = false;
                }
                $("#audio-repeat-source")[0].src = random.audio;
                $("#audio-repeat")[0].load();
                $("#audio-repeat")[0].play();
            }

            function dungroi(){
                setTimeout(()=>{
                    $("#audio-repeat-source")[0].src = 'https://dm0qx8t0i9gc9.cloudfront.net/previews/audio/BsTwCwBHBjzwub4i4/audioblocks-successfully-organ-chord-achievement-4_BZHW4iOmYv8_NWM.mp3';
                    $("#audio-repeat")[0].load();
                    $("#audio-repeat")[0].play().then(()=>{
                    });
                    flag_success = true;
                },1000)
                playRandom();


            }


        }
    </script>
@endsection
