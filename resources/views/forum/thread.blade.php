@extends('layouts/forum/app_blank')
@section('header')

@endsection
@section('content')
    @foreach($dataThreadData['mainthread'] as $thread)
        <div class="card">
            {!! $thread->html !!}
        </div>
    @endforeach
{{--{{$dataThreadCat}}--}}
@foreach($dataThreadData['commentthread'] as $thread)

    <div class="card">
        <div class="card-header">
            <div class="font-weight-bold">{{$thread->username}}</div>
            {{date('Y/m/d h:i:s',$thread->dateline)}}
        </div>
        <div class="card-body">
            {!! $thread->html !!}
        </div>
    </div>
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
