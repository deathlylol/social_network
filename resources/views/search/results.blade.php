@extends('templates.default')
@section('content')
    <div class="row mt-5">
        <div class="container">
            <div class="col-lg-6 p-0">
                <h3>Результат поиска: {{ Request::input('search') }}</h3>
                @if(!$users->count())
                    <p>Пользователь не найден</p>
                @else
                    <div class="row">
                        <div class="d-flex">
                            @foreach($users as $user)
                                @include('user.partials.userblock')
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
