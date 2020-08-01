<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            {{--<img src="http://placehold.it/150x50?text=Logo" alt="">--}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('plantuml.index')}}"><i class="fa fa-home"></i> Homepage
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('plantuml.create')}}"><i class="fa fa-plus-circle"></i> Create UML</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="create-category" href="javascript:void(0)"><i class="fa fa-plus-circle"></i>
                        Create Category</a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i
                                class="fa fa-sign-in-alt"></i> {{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"><i
                                class="fa fa-registered"></i> {{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('plantuml.byuser',["id"=>\Illuminate\Support\Facades\Auth::id()]) }}">
                            My UML
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<div class="container">
    {{Session::flash('error')}}
    <h1>{{$name_page??'UML'}}</h1>
    {{--    <h2><i class="fa fa-archive"></i> Project list </h2>--}}
    <div><h2>Project name: {{Session::get('current_projectI')['name']}}</h2></div>

    <div>{{Session::get('current_projectI')['desc']}}</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <form action="/plantuml/save-category" method="post">

            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><input type="text" name="name" placeholder="Category name" class="form-control"></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
