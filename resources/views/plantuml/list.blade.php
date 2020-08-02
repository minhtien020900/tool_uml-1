@extends('layouts/app')
@section('header')

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->


@endsection

@section('content')
    <table class="table table-hover ">
        <thead>
        <tr class="">
            <th class="text-center " style="max-width: 10px;"><a href="?sortby=id">Id</a></th>
            <th class="text-center " style="max-width: 20px;"><a href="#">IMG</a></th>
            <th class="text-left "><a href="?sortby=project">Project</a></th>
            <th class="text-left "><a href="?sortby=name">Name</a></th>
            <th class="text-left "><a href="?sortby=user">User</a></th>
            <th class="text-right "></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr class="">
                <td class="text-center " style="max-width: 10px;">{{$v->id}}</td>
                <td class="text-center " style="max-width: 75px;">
                    <a href="{{$v->getUrlByCache()}}.png" data-fancybox>
                        <img style="max-width: 70px;" class="preview_img1"  src="{{$v->getUrlByCache()}}.png"
                         type="image/svg+xml">
                    </a>
                </td>
                <td class="text-left ">{{$v->project->name??''}} </td>
                <td class="text-left ">{{$v->name}} </td>
                <td class="text-left ">{{$v->user->name??''}} </td>

                <td class="text-right">
                    <a href="{{route('plantuml.show',(!isset($v->project->name)?$v->name:$v->project->name."/".$v->id.'-'.$v->name.'.svg'))}}"
                       target="_blank">SVG</a>

                    <a href="{{route('plantuml.show',(!isset($v->project->name)?$v->name:$v->project->name."/".$v->id.'-'.$v->name.'.png'))}}"
                       target="_blank">PNG</a>
                    @if($v->user_id == Auth::id())
                        <a id="planteditorlink" target="" href="{{route('plantuml.edit',$v->id.'-'.$v->name)}}"><i
                                class="fa fa-pencil-alt" aria-hidden="true"></i></a>

                        <i class="fas fa-trash-alt"></i>
                    @else
                        <a id="planteditorlink" target="" href="{{route('plantuml.edit',$v->id.'-'.$v->name)}}"><i
                                class="fa fa-eye" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="background-hover"></div>
    <style type="text/css" media="screen">
        .preview_img {
            position: relative;
            height: 50px;
        }

        .background-hover.ihover {
            background: #00000054;
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
        }

        .preview_img.ihover {
            position: absolute;
            height: auto;
            z-index: 12;
            max-width: fit-content !important;
            border: 4px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
        $(".preview_img").click(function () {
            $(this).toggleClass('ihover');
            $(".background-hover").toggleClass('ihover');
        })
        $(document).click(function (e) {
            if (!$(e.target).is("img.preview_img")) {
                $(".preview_img").removeClass('ihover');
                $(".background-hover").removeClass('ihover');
            }
        })
    </script>
@endsection
