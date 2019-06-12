<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            {{--<img src="http://placehold.it/150x50?text=Logo" alt="">--}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item d-none">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i>  {{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-registered"></i> {{ __('Register') }}</a>
                </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('plantuml.byuser',["id"=>\Illuminate\Support\Facades\Auth::id()]) }}">
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