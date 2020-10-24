@extends('layouts/forum/app_blank')
@section('header')

@endsection
@section('content')

{{--{{$dataCat}}--}}
@foreach($dataCat as $cat)
    <div><a href="/forum?cat={{$cat->forumid}}">{{$cat->title}}</a></div>
@endforeach
<hr>
{{--{{$dataThreadCat}}--}}
@foreach($dataThreadCat as $thread)
{{--    <pre>{{$thread->title}}</pre>--}}
    <div><a href="/thread?threadid={{$thread->threadid}}">{{$thread->title}}</a></div>
@endforeach
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

@endsection
