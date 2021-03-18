@extends('templates.default')
@section('content')
    <div class="container">
        <div class="wall-background">
            <img src="{{ $user->getWall() }}" alt="wall-wrapper" class="wall-image img-fluid">
        </div>
        <div class="wall-avatar">
            <div class="wrap-avatar">
                <div
                    style="height: 168px;width: 168px;border-radius: 50%;overflow: hidden; margin: 0 auto;border: 4px solid #fff">
                    <img src="{{ $user->getAvatar() }}" alt="фото {{ $user->first_name }}">
                </div>
            </div>
            @if(Auth::user()->id == $user->id)
                <div class="change-avatar-block d-flex">
            <span>
                <a href="{{ route('user.wall-img',['id' => $user->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-camera-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path
                          d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg> Редактировать фото обложки
                </a>
            </span>
                    <span>
                <a href="{{ route('user.avatar',['id' => $user->id]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-camera-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path
                          d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg> Редактировать аватарку
                </a>
            </span>
                </div>
            @endif
        </div>
    </div>
    <div class="profile-info-block pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 pl-0">
                    <div class="profile-info">
                        <h4 class="pl-3 pt-3">Краткая информация</h4>
                        <ul>
                            <li>{{!empty($user->location) ? "Живёт в г." . $user->location: '' }}</li>
                            <li>{{!empty($user->job) ? "Работает в " . $user->job: '' }}</li>
                            <li>{{!empty($user->school) ? "Учился в " . $user->school: '' }}</li>
                            @if(Auth::user()->id == $user->id)
                                <li><a href="{{ route('profile.edit',['id' => $user->id]) }}">Редактировать
                                        информацию</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="profile-info mt-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="pl-3 pt-3">Друзья</h4>
                            @if(Auth::user()->canDeleteByFriend($user->id) || Auth::user()->canDeleteByUser($user->id) )
                                <button type="submit" class="btn btn-danger delete-friend" data-id="{{$user->id}}">
                                    Удалить из друзей
                                </button>
                            @elseif(Auth::user()->friendRequestsById($user->id))
                                <button type="submit" class="btn btn-info delete-friend" data-id="{{$user->id}}">
                                    Отменить запрос
                                </button>
                            @elseif(Auth::user()->id != $user->id)
                                <button type="submit" class="btn btn-primary friend-subm" data-id="{{$user->id}}">
                                    Добавить в друзья
                                </button>
                            @endif
                        </div>

                        <ul class="d-flex flex-wrap">
                            @if (!$user->friends()->count())
                                <p>Нет друзей.</p>
                            @else
                                @foreach($user->friends() as $friend)
                                    <li style="padding-right: 15px;padding-top:15px">
                                        <div style="width: 50px;height: 50px;border-radius: 100%;overflow:hidden">
                                            <img src="{{$friend->getAvatar()}}" alt=""
                                                 style="width: 100%;height: 100%;object-fit: cover;">
                                        </div>
                                        <a href="{{ route('profile.index',['id' => $friend->id]) }}">{{ $friend->getName() }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="profile-info">
                        <div style="padding: 10px 15px;">
                            @if(Auth::user()->id == $user->id)
                                <form action="{{route('user.post')}}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid':''}}"
                                              placeholder="Поделитесь вашими новостями."
                                              name="body"></textarea>
                                        @if($errors->has('body'))
                                            <div class="invalid-feedback">
                                                <p>{{$errors->first('body')}}</p>
                                            </div>
                                        @endif
                                        <div class="input-group mt-2">
                                            <button class="btn btn-outline-primary" type="submit">Поделиться</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <h4>Публикации</h4>
                            @endif
                        </div>
                    </div>
                    @foreach($posts as $post)
                        <div class="profile-info mt-3 mb-3">
                            <div class="media" style="padding: 15px">
                                <img class="mr-3" src="{{ $user->getAvatar() }}" alt="Generic placeholder image"
                                     style="height: 64px;width:64px;object-fit: cover; border-radius: 50%">
                                <div class="media-body">
                                    {{$post['body']}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-2">
                    <div class="profile-info pb-3">
                        <h6 class="pl-3 pt-3">Запросы в друзья</h6>
                        @if (!$friend_requests->count())
                            <p class="pl-3">Нет запросов в друзья.</p>
                        @else
                            @foreach($friend_requests as $user_friend)
                                <div class="user_friend pl-3">
                                    <p class="user_friend"></p>
                                    <div class="d-flex align-items-center">
                                        <div style="width: 50px;height: 50px;border-radius: 100%;overflow:hidden">
                                            <img src="{{$user_friend->getAvatar()}}" alt=""
                                                 style="width: 100%;height: 100%;object-fit: cover;">
                                        </div>
                                        <a href="{{ route('profile.index',['id' => $user_friend->id]) }}"
                                           class="pl-2">{{ $user_friend->getName() }}</a>
                                    </div>
                                    <span class="btn btn-outline-primary accept mt-2" data-id="{{$user_friend->id}}">Принять</span>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('document').ready(function () {

                $('.accept').on('click', function () {
                    let li_block = $(this);
                    let friend_id = $(this).attr('data-id');
                    $.ajax({
                        dataType: "json",
                        url: '{{ route('user.add-friend') }}',
                        type: "POST",
                        data: {
                            user_id: {{$user->id}},
                            friend_id: friend_id,
                            accepted: true,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                });

                $('.delete-friend').on('click', function () {
                    let friend_id = $(this).attr('data-id');
                    $.ajax({
                        dataType: "json",
                        url: '{{ route('user.destroy') }}',
                        type: "POST",
                        data: {
                            friend_id: friend_id,
                            accepted: true,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            location.reload();
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                });

                $('.friend-subm').on('click', function () {
                    let friend_id = $(this).attr('data-id');
                    let button = $(this);
                    $.ajax({
                        dataType: "json",
                        url: '{{ route('user.request-friend') }}',
                        type: "POST",
                        data: {
                            friend_id: friend_id,
                            accepted: true,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (data) {
                            button.removeClass('btn-primary friend-subm').addClass('btn-warning delete-friend').text('Отменить запрос');
                            location.reload();
                        },
                        error: function (msg) {
                            alert('Ошибка');
                        }
                    });
                });

            })
        </script>
    @endpush
@endsection
