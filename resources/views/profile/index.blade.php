@extends('templates.default')
@section('content')
    <div class="container">
        <div class="wall-background">
            <img src="{{asset('wall/rock.jpg')}}" alt="" class="wall-image img-fluid">
        </div>
        <div class="wall-avatar">
            <div class="wrap-avatar">
                <img src="{{ $user->getAvatar() }}" alt="фото {{ $user->first_name }}" class="rounded-circle">
            </div>
            <div class="change-avatar-block">
            <span>
                <a href="{{ route('user.index',['id' => $user->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg> Редактировать аватарку
                </a>
            </span>
            </div>
        </div>
    </div>
    <div class="profile-info-block">
        <div class="container">
            <div class="col-lg-4">
                <div class="profile-info">
                    <h4 class="pl-3">Краткая информация</h4>
                    <ul>
                        <li>{{!empty($user->location) ? "Живёт в г." . $user->location: '' }}</li>
                        <li>{{!empty($user->job) ? "Работает в " . $user->job: '' }}</li>
                        <li>{{!empty($user->school) ? "Учился в " . $user->school: '' }}</li>
                        <li><a href="{{ route('profile.edit',['id' => $user->id]) }}">Редактировать информацию</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
