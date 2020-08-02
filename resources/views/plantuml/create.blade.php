@extends('layouts/app')
@section('header')


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" href="/lib/bootstrap-tagsinput/bootstrap-tagsinput.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
@endsection

@section('content')

    <div class=''>
        <div class='row'>
            <div class='col-12 mt-3'>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(!isset($uml->name))
                    <form action="{{route('plantuml.store')}}" method="POST" role="form" id="uml-form">
                        @else
                            <form action="{{route('plantuml.update',$uml->name)}}" method="POST" role="form"
                                  id="uml-form">
                                <input name="_method" type="hidden" value="PUT">
                                @endif
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
                                <div class="form-group">
                                    <label for="">Name diagram</label>
                                    {{--required--}}
                                    <input type="text" {{isset($uml->name)?'':''}} name="name" class="form-control"
                                           id="" placeholder="Input field" value="{{old('name',$uml->name??"")}}">
                                    <input type="hidden" {{isset($uml->name)?'':''}} name="id" class="form-control"
                                           id="" placeholder="Input field" value="{{old('name',$uml->id??"")}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Project</label>
                                </div>
                                <div class="form-group">

                                    <select class="form-control" name="project">

                                        <option disabled>==Project==</option>
                                        @foreach(($projects??[]) as $value)
                                            <option
                                                value="{{$value['id']}}" {{ ($value['id'] == (old('project',($uml->project_id ?? "") )??'') ? 'selected' : $uml === null && Session::get('current_projectI')['id'] === $value['id'] )?"selected":'' }}>
                                                {{($value['name'])}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    @if(isset($uml->created_at))
                                        <div><strong>Author</strong>: {{$uml->user->name}}</div>
                                        <div>
                                            <strong>Created_at:</strong> {{isset($uml->created_at)?$uml->created_at:''}}
                                        </div>
                                    @endif
                                    @if(isset($uml->updated_at))
                                        <div>
                                            <strong>Updated_at:</strong> {{isset($uml->updated_at)?$uml->updated_at:''}}
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Code diagram</label>
                                            <div style="position:relative;height:500px;">
                                                <div id="editor">{{old('code',$uml->code??"")}}</div>
                                            </div>
                                            <textarea name="code"
                                                      class="d-none">{{old('code',$uml->code??"")}}</textarea>

                                            <div id="tag-wrap">
                                                <h3>Tags</h3>
                                                <input type="text" name="tags" id="inputTags"
                                                       value="{{old('code',$uml->tags??"")}}">
                                            </div>

                                            <div class="mt-3">
                                                <button class="btn btn-success build">Preview img</button>
                                                <i id="icon-loading" class="fas fa-spinner  fa-spin d-none"></i>
                                                @if(Route::currentRouteName() == 'plantuml.create' || $uml->user_id == Auth::id() )
                                                    <button type="submit" class="btn btn-primary">Save diagram</button>
                                                @endif</div>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group">

                                            @if(isset($uml->code)?true:false)
                                                <a data-fancybox data-caption="Caption for single image"
                                                   href="https://www.plantuml.com/plantuml/img/{{isset($uml->url)?$uml->url:""}}"><img
                                                        class="preview"
                                                        src="https://www.plantuml.com/plantuml/img/{{isset($uml->url)?$uml->url:""}}"></a>
                                            @else
                                                <a data-fancybox data-caption="Caption for single image"
                                                   href="https://www.plantuml.com/plantuml/img/{{isset($uml->url)?$uml->url:""}}"><img
                                                        class="preview" src="http://placehold.it/200x200"></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </form>
            </div>
        </div>
    </div>



    @if(isset($uml_history) && count($uml_history)>0)
        <h2>History</h2>
        <div class="row" id="history-wrap" class="fancybox">
            @foreach($uml_history as $v)
                <div class="col-3">

                    <h3>{{$v->name}}</h3>
                    <div>{{$v->updated_at}} ({{round(s_datediff('h',$v->updated_at,date('Y-m-d h:n:s')),2)}})h  </div>
                    {!! $v->getUrlImg() !!}
                </div>
            @endforeach
        </div>
    @endif
    <style type="text/css" media="screen">
        #history-wrap img {
            max-width: 100%;
        }

        .preview {
            max-width: 100%;
        }

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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.4/ace.js" type="text/javascript"
            charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");


        var textarea = $('textarea[name="code"]');

        editor.getSession().on("change", function () {
            textarea.val(editor.getSession().getValue());
        });
        $(".build").click(function (e) {
            e.preventDefault();
            loading('show');
            $.get('{{route('plantuml.build')}}', {text: textarea.val()}, function (resp) {
                $('.preview').attr('src', resp.planttext.png)
                loading('hide');
            })
        });
        editor.commands.addCommand({
            name: 'replace',
            bindKey: {win: 'Ctrl-Enter'},
            exec: function (editor) {
                $(".build").trigger('click');

            },
            readOnly: true
        });

        function loading(option) {
            if (option == 'show') {
                $('.preview').addClass('d-none');
                $(".fas.fa-spinner#icon-loading").removeClass('d-none');
            } else {
                $('.preview').removeClass('d-none');
                $(".fas.fa-spinner#icon-loading").addClass('d-none');
            }


        }
    </script>
    <script src="/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#inputTags").tagsinput('items')
        })
        // prevent ctrl + s
        $(document).bind('keydown', function (e) {
            if (e.ctrlKey && (e.which == 83)) {
                e.preventDefault();
                console.log('dd');
                if (window.confirm('Do you want save diagram ?')) {
                    $('#uml-form').submit();

                }
                return false;
            }
        });
    </script>
@endsection




