@extends('templates.default')
@section('content')
    <div class="col-lg-4 mx-auto">
        <h1>Авторизация</h1>
        <form method="post" action="{{ route('auth.signin') }}" novalidate>
            @csrf
            <div class="mb-3">
                @if($errors->has('username'))
                    <label for="username"
                           class="form-label help-block text-danger">{{$errors->first('username')}}</label>
                @else
                    <label for="username" class="form-label">Логин</label>
                @endif
                <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid': ''}}"
                       id="username" placeholder="loginExample" value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                @if($errors->has('password'))
                    <label for="password"
                           class="form-label help-block text-danger">{{$errors->first('password')}}</label>
                @else
                    <label for="password" class="form-label">Пароль</label>
                @endif
                <input type="password" name="password"
                       class="form-control {{$errors->has('password') ? 'is-invalid': ''}}" id="password"
                       placeholder="Пароль">
            </div>
            <div class="d-flex justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" name="remember" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Запомнить вход
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </div>
        </form>
    </div>
@endsection
