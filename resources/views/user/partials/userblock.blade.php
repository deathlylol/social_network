<div class="card" style="width: 18rem;">
    <a href="#"><img src="public/noah.jpg" class="card-img-top" alt="avatar"></a>
    <div class="card-body">
        <p class="card-text"><a href="#">{{ $user->getName() }}</a></p>
    </div>

    @if($user->location)
        <p>{{ $user->location  }}</p>
    @endif
</div>
