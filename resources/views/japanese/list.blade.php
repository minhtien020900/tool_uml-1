@extends('layouts/app_blank')
@section('header')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        img{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        @foreach($vocabularies as $v)
                            <tr>
                                <td><a>{!! $v[0] !!}</a></td>
                                <td><a>{!! $v[1] !!}</a></td>
                                <td><a>{!! $v[3] !!}</a></td>
                                <td><a>{!! $v[5] !!}</a></td>
                                <td><img data-id="{!! $v[0] !!}" src="{!! $v[6]??'' !!}"></td>
                                <td>
                                    @if(isset($v[7]))
                                        <audio controls id="audio_{!! $v[0] !!}">
                                            <source src="{!! $v[7]??'' !!}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script>
    $(document).ready(function(){})
    $('img').click(function (){
        $('#audio_'+$(this).data('id'))[0].play()
        //console.log();
    });
</script>
@endsection
