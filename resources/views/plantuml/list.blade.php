<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tool</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


        <![endif]-->

    </head>
    <body>

        <div class='container'>
            {{Session::flash('error')}}
            <!-- Navigation -->
            @include('plantuml/navbar')
            <hr>

            <div class='row mb-3'>
                <div class='col-12'>
                    <a class="btn btn-primary" href="{{route('plantuml.create')}}" >Create new UML</a>
                </div>
            </div>



        </div>
        <div class="container">
            <div class='row'>
                <div class='col-12'>

                    <table class="table table-hover ">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th></th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $v)

                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->name}} </td>
                                {{--<td ><input value="{{$v->url}}" style="width:300px;" class="form-control"></td>--}}
                                {{--<td ><input value="{{env('APP_URL')}}/show_url/{{$v->name}}" style="width:300px;" class="form-control"></td>--}}

                                <td class="text-right">
                                    <a href="{{route('plantuml.show',$v->name)}}" target="_blank"><i class="fas fa-image"></i></a>
                                    <a id="planteditorlink" target="_blank" href="{{route('plantuml.edit',$v->name)}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i></a>
                                    <i class="fas fa-trash-alt"></i>
                                </td>
                                <td class="d-none"><div id="content">
                                        {{--<a id="plantimagelink" target="_blank" href="https://www.plantuml.com/plantuml/img/{{$v->url}}">PNG</a>&nbsp;|&nbsp;--}}
                                        {{--<a id="plantsvglink" target="_blank" href="https://www.plantuml.com/plantuml/svg/{{$v->url}}">SVG</a>&nbsp;|&nbsp;--}}
                                        {{--<a id="planttxtlink" target="_blank" href="https://www.plantuml.com/plantuml/txt/{{$v->url}}">TXT</a>&nbsp;|&nbsp;--}}

                                    </div></td>
                            </tr>
                            <tr class="d-none">
                                <td colspan="4">
                                    <textarea class="form-control d-none">{{$v->code}}</textarea>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <style type="text/css" media="screen">
            #editor {
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }
        </style>



        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js" type="text/javascript" charset="utf-8"></script>
        <script>
            var editor = ace.edit("editor");
            editor.setTheme("ace/theme/monokai");
            editor.session.setMode("ace/mode/javascript");


            var textarea = $('textarea[name="code"]');

            editor.getSession().on("change", function () {
                textarea.val(editor.getSession().getValue());
            });
        </script>
    </body>
    </html>