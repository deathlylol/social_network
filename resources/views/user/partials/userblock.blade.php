<div class="card card-user" style="width: 18rem;">
    <a href="{{ route('profile.index',['id' => $user->id]) }}"><img src="{{ $user->getAvatar() }}" class="card-img-top" alt="avatar"></a>
    <div class="card-body">
        <p class="card-text"><a href="{{ route('profile.index',['id' => $user->id]) }}">{{ $user->getName() }}</a></p>
    </div>
    @if($user->location)
        <p>{{ $user->location  }}</p>
    @endif
</div>
{{--{{ asset('users_avatar'). '/' . $user->avatar  }}--}}
