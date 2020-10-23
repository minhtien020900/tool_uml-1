@extends('layouts/forum/app_blank')
@section('header')

@endsection
@section('content')

    <ul id="list-forum">
        @foreach($data as $d)
            <li><a  class="link-forum" data-id="{{$d['data']->forumid}}" href="#">{{$d['data']->title}}</a></li>
            <ul>
            @foreach($d['child'] as $c)
                <li><a class="link-forum" data-id="{{$c->forumid}}" href="#">{{$c->title}}</a></li>
            @endforeach
            </ul>
        @endforeach

    </ul>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        var list_forum = [];

        function renderThread(v) {
            return "<div><a class='detail-thread' href='#' data-id='"+v.threadid+"'>"+v.title+"</a></div>";
        }

        $(document).on('click',"#contentThread span",function(){
            $(this).parent('div').remove();
        });

        function renderDetailThread(v) {
            return "<div>" +
                "<strong>username: </strong>"+v.username+"<br>"+
                "<div>"+v.html+"</div><hr>" +
                "</div>";
        }

        $(document).on('click',".detail-thread",function(){
            $.post('/api/get-detail-thread/'+$(this).data('id'), (data) => {
                let string = '';
                $.each(data,function(k,v){
                    string += renderDetailThread(v);
                })
                $(".modal .modal-body").html(string);
                $(".modal").modal();
            })
        });

        $('.link-forum').click(function(){
            $.post('/api/get-thread/'+$(this).data('id'), (data) => {
                let string = '';
                $.each(data,function(k,v){
                    string += renderThread(v);
                })
                $('#contentThread').remove();
                $(this).after('<div id="contentThread"><span>Close</span>'+string+'</div>');
            })
        })
        function render() {
            $("#list-forum").html();

            console.log(list_forum);
        }

        $.post('/api/get-parent-forum', (data) => {

            list_forum = data;
            render();
        })

    </script>
@endsection
