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
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-camera-fill" viewBox="0 0 16 16">
                      <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                      <path
                          d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z"/>
                    </svg> Редактировать аватарку
                </a>
            </span>
            </div>
        </div>
    </div>
    <div class="profile-info-block pt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 pl-0">
                    <div class="profile-info">
                        <h4 class="pl-3">Краткая информация</h4>
                        <ul>
                            <li>{{!empty($user->location) ? "Живёт в г." . $user->location: '' }}</li>
                            <li>{{!empty($user->job) ? "Работает в " . $user->job: '' }}</li>
                            <li>{{!empty($user->school) ? "Учился в " . $user->school: '' }}</li>
                            <li><a href="{{ route('profile.edit',['id' => $user->id]) }}">Редактировать информацию</a>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-info mt-2">
                        <h4 class="pl-3">Друзья</h4>
                        <ul>
                            @if (!$user->friends()->count())
                                <p>Нет друзей.</p>
                            @else
                                @foreach($user->friends() as $friend)
                                    <li>
                                        <a href="{{ route('profile.index',['id' => $friend->id]) }}">{{ $friend->getName() }}</a>
                                    </li>
                                    <li class="ajax-li">
                                        <a href="#" class="ajax-a"></a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="profile-info">
                        <div style="padding: 10px 15px;">
                            <form action="" method="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Что у вас нового?" name="userNews">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button">Поделиться</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="profile-info">
                        <p class="pl-3">Запросы в друзья</p>
                        <ul>
                            @if (!$friend_requests->count())
                                <p>Нет запросов в друзья.</p>
                            @else
                                @foreach($friend_requests as $user_friend)
                                    <li class="user_friend">
                                        <p class="user_friend"></p>
                                        <a href="{{ route('profile.index',['id' => $user_friend->id]) }}">{{ $user_friend->getName() }}</a>
                                        <span class="btn btn-outline-primary accept" data-id="{{$user_friend->id}}">Принять</span>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
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
                            li_block.parent().remove();
                            $('.accept-user').css({'display': 'block'}).$('.user_friend').css({'display': 'block'}).text("Теперь вы друзья с " + data['username']);
                            $('.ajax-li').css({'display': 'block'}).find('.ajax-a').text(data['username']);
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
