@extends('layouts/app_blank_japanese')
@section('header')
    <style>
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="text-center">
            <strong></strong>
        </div>
        <input class="form-control">
    </div>

    @foreach($vocabularies as $v)
        <div class="d-none ele-voca" data-id="{!! $v[0] !!}" data-text ='{!! $v[1] !!}' data-meaning ='{!! $v[5] !!}'>{!! $v[1] !!}
            <img data-id="{!! $v[0] !!}" src="{!! $v[6]??'' !!}">
            @if(isset($v[7]))
                <audio hidden controls id="audio_{!! $v[0] !!}" src="{!! $v[7]??'' !!}">
                    <source src="{!! $v[7]??'' !!}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            @endif
        </div>
    @endforeach
    <audio hidden controls id="audio-repeat">
        <source src="http://dev.japanese.oop.vn/storage/japanese_audio/Bai2/9_jishiyo_Tu_dien.mp3" type="audio/mpeg" id="audio-repeat-source">
        Your browser does not support the audio element.
    </audio>
@endsection
@section('footer')
<script>
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
        if ($(v).data('text')) {
            this.text = $(v).data('text');
        } else {
            this.text = '';
        }
        if ($(v).data('meaning')) {
            this.meaning = $(v).data('meaning');
        } else {
            this.meaning = '';
        }
    };
    let vocalist = [];
    $(".ele-voca").each((k, v) => {
        vocalist.push(new voca(v));
    });
    var random = vocalist[~~(vocalist.length * Math.random())];
    showQuestion(random);

    function showQuestion(question){
        $('strong').text(question.meaning)
    }
    $('input').on('keydown',function(e){
        if(e.keyCode === 13){
            if($(this).val().trim()===random.text){
                $("#audio-repeat-source")[0].src = 'https://dm0qx8t0i9gc9.cloudfront.net/previews/audio/BsTwCwBHBjzwub4i4/audioblocks-successfully-organ-chord-achievement-4_BZHW4iOmYv8_NWM.mp3';
                $("#audio-repeat")[0].load();
                $("#audio-repeat")[0].play().then(()=>{
                });
            }else{
                $("#audio-repeat-source")[0].src = 'https://dm0qx8t0i9gc9.cloudfront.net/previews/audio/BsTwCwBHBjzwub4i4/audioblocks-game-funny-fail-2-lose-incorrect-answer-arcade-lose-incorrect-answer-arcade_rYcM9WGICv8_NWM.mp3';
                $("#audio-repeat")[0].load();
                $("#audio-repeat")[0].play().then(()=>{
                });
            }
        }
    })

</script>
@endsection
