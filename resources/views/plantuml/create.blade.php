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

    @include('plantuml/navbar')
    <div class='row'>
        <div class='col-12 mt-3'>

            @if(!isset($data->name))
                <form action="{{route('plantuml.store')}}" method="POST" role="form">
                    @else
                        <form action="{{route('plantuml.update',$data->name)}}" method="POST" role="form">
                            <input name="_method" type="hidden" value="PUT">
                            @endif
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>

                            <div class="form-group">
                                <label for="">Name diagram</label>
                                <input required type="text" {{isset($data->name)?'readonly':''}} name="name" class="form-control" id="" placeholder="Input field" value="{{isset($data->name)?$data->name:""}}">
                            </div>
                            <div class="form-group">
                                @if(isset($data->created_at))
                                    <div>Created_at: {{isset($data->created_at)?$data->created_at:''}}</div>
                                @endif
                                @if(isset($data->updated_at))
                                   <div>Updated_at: {{isset($data->updated_at)?$data->updated_at:''}}</div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Code diagram</label>
                                        <div style="position:relative;height:500px;">
                                            <div id="editor">{{isset($data->code)?$data->code:""}}</div>
                                        </div>
                                        <textarea name="code" class="d-none">{{isset($data->code)?$data->code:""}}</textarea>
                                        <button class="btn btn-success build">Preview img</button>
                                        <i id="icon-loading" class="fas fa-spinner  fa-spin d-none"></i>
                                        <button type="submit" class="btn btn-primary">Save diagram</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        @if(isset($data->code)?true:false)
                                            <img class="preview" src="https://www.plantuml.com/plantuml/img/{{isset($data->url)?$data->url:""}}">
                                        @else
                                            <img class="preview" src="http://placehold.it/200x200">
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </form>
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
</body>
</html>

