@extends('layouts/app')
@section('header')

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->


@endsection

@section('content')

    <div class='container'>
    {{Session::flash('error')}}
    <!-- Navigation -->
        <hr>

        <div class='row mb-3'>
            <div class='col-12'>
                <a class="btn btn-primary" href="{{route('plantuml.create')}}">Create new UML</a>
            </div>
        </div>


    </div>
    <div class="container">
        <div class='row'>
            <div class='col-12'>
                <table class="table table-hover ">
                    <thead>
                    <tr class="">
                        <th class="text-center " style="max-width: 10px;">Id</th>
                        <th class="text-center " style="max-width: 20px;">IMG</th>
                        <th class="text-left ">Name</th>
                        <th class="text-right "></th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $v)
                        <tr class="">
                            <td class="text-center " style="max-width: 10px;">{{$v->id}}</td>
                            <td class="text-center " style="max-width: 20px;">
                                <img class="preview_img" src="{{$v->getUrlByCache()}}" style=""></td>
                            <td class="text-left ">{{$v->name}} </td>

                            <td class="text-right" >
                                    <a href="{{route('plantuml.show',$v->name)}}" target="_blank"><i class="fas fa-image"></i></a>
                            <a id="planteditorlink" target="_blank" href="{{route('plantuml.edit',$v->name)}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                            <i class="fas fa-trash-alt"></i>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <style type="text/css" media="screen">
        .preview_img {
            position: relative;
            height: 50px;
        }

        .preview_img.ihover {
            position: absolute;
            height: auto;
            z-index: 12;
        }
    </style>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
        $(".preview_img").click(function () {
            $(this).toggleClass('ihover');
        })
        $(document).click(function (e) {
            if (!$(e.target).is("img.preview_img")) {
                $(".preview_img").removeClass('ihover');
            }
        })
    </script>
@endsection