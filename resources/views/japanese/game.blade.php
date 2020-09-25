@extends('layouts/app_blank')
@section('header')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        img{
            cursor: pointer;
        }

        .ele-voca{
            float: left;
            width:200px;
            height:200px;
            margin:5px;
            box-shadow: 1px 1px 1px #ccc;
        }
        .ele-voca img{
            max-height: 100%;
            max-width: 100%;
        }
        @media only screen and (max-width: 600px) {
            .ele-voca{
                float: left;
                width:85px;
                height:85px;
                margin:5px;
                box-shadow: 1px 1px 1px #ccc;
            }
            .ele-voca img{
                max-height: 100%;
                max-width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
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
@endsection
@section('footer')
    <script>
        var voca = function(v){

            this.id = $(v).data('id');


            if($(v).children('img').length>0){
                this.img = $(v).children('img')[0].getAttribute('src');
            }else{
                this.img ='';
            }

            if($(v).children('audio').length>0){
                this.audio = $(v).children('audio')[0].getAttribute('src');
            }else{
                this.audio ='';
            }

        };
        voca.prototype.showss  = function(){
        }
        // let m = new voca();
        // m.showss();
        let vocalist = [];
        $(".ele-voca").each((k,v)=>{
            vocalist.push(new voca(v));
        });



        $(document).ready(function(){})
        $('img').click(function (){
            $('#audio_'+$(this).data('id'))[0].play()
            //console.log();
        });
    </script>
@endsection
