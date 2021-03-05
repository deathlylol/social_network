@extends('templates.default')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mt-5" style="margin-left: auto;margin-right: auto;">
                <div class="social-wrap">
                    <h1>Регистрация</h1>
                    <form method="post" action="{{ route('auth.signup') }}" novalidate>
                        @csrf
                        <div class="mb-3">
                            @if($errors->has('email'))
                                <label for="email"
                                       class="form-label help-block text-danger">{{$errors->first('email')}}</label>
                            @else
                                <label for="email" class="form-label">Email</label>
                            @endif
                            <input type="email" name="email"
                                   class="form-control {{$errors->has('email') ? 'is-invalid': ''}}"
                                   id="email" placeholder="user@gmail.com" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            @if($errors->has('username'))
                                <label for="username"
                                       class="form-label help-block text-danger">{{$errors->first('username')}}</label>
                            @else
                                <label for="username" class="form-label">Логин</label>
                            @endif
                            <input type="text" name="username"
                                   class="form-control {{$errors->has('username') ? 'is-invalid': ''}}"
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
                                   class="form-control {{$errors->has('password') ? 'is-invalid': ''}}"
                                   id="password"
                                   placeholder="Пароль">
                        </div>
                        <button type="submit" class="btn btn-primary">Создать аккаунт</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
