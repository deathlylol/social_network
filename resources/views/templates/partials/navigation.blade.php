<nav class="navbar navbar-light bg-light  navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">SOCIAL NETWORK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
{{--            @if(Auth::check())--}}
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Стена</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Друзья</a></li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Поиск..." aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Найти</button>
                </form>
                <ul class="navbar-nav ml-auto">
{{--                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">{{Auth::user()->getNameOrUsername}}</a></li>--}}
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Обновить профиль</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Выйти</a></li>
                </ul>
{{--            @else--}}
{{--                <ul class="navbar-nav justify-content-end w-100">--}}
{{--                    <li class="nav-item"><a class="nav-link" href="/">Зарегистрироваться</a></li>--}}
{{--                    <li class="nav-item"><a class="nav-link" href="/">Войти</a></li>--}}
{{--                </ul>--}}
{{--            @endif--}}
        </div>
    </div>
</nav>
