<div class="card card-user" style="width: 18rem;">
    <div style="max-height: 178px;">
        <a href="{{ route('profile.index',['id' => $user->id]) }}">
            <img src="{{ $user->getAvatar() }}" class="card-img-top" alt="avatar" style="height: 100%;width: 100%;object-fit: cover">
        </a>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-baseline justify-content-between">
            <p class="card-text">
                <a href="{{ route('profile.index',['id' => $user->id]) }}">{{ $user->getName() }}</a>
            </p>
            <button type="submit" class="btn btn-primary friend-subm" data-id="{{$user->id}}">Добавить в друзья</button>
        </div>
    </div>
</div>
