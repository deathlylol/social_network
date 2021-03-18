<nav class="navbar navbar-light bg-light  navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">UNHOLY NETWORK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
            @if(Auth::check())
                <div class="d-flex">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Стена</a></li>
                    </ul>
                    <form method="GET" action="{{ route('search.index') }}" class="d-flex" style="margin-left: 10px">
                        <input class="form-control me-2" type="search" placeholder="Поиск..." aria-label="Search" name="search" value="{{ Request::input('search') }}">
                        <button class="btn btn-outline-primary ml-1" type="submit">Найти</button>
                    </form>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                                            href="{{ route('profile.index',['id' => Auth::user()->id]) }}">{{Auth::user()->getName()}}</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ Route('auth.logout') }}">Выйти</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>
