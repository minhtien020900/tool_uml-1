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

@endsection
@section('footer')
    <script>

        var data_voca = [];
        $(document).ready(()=>{
            $.get( "/api/card?l=2", function( data ) {
                data_voca = data;
                console.table(data_voca);
            });
        })
    </script>
@endsection
