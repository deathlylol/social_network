@extends('templates.default')
@section('content')
    <div class="profile-info-block" style="min-height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if(!$posts->count())
                        <h3>Пока нет постов.</h3>
                    @else
                        @foreach($posts as $post)
                            <div class="profile-info mt-3 mb-3">
                                <div class="media" style="padding: 15px">
                                    <img class="mr-3"
                                         src="{{$post->user->getAvatar()}}"
                                         alt="Generic placeholder image"
                                         style="height: 64px;width:64px;object-fit: cover; border-radius: 50%">
                                    <div class="media-body">
                                        <p><a href="">{{$post->user->getName()}}</a></p>
                                        {{$post->body}}
                                        <p class="mt-3">Опубликовано: <b>{{$post->created_at->diffForHumans()}}</b></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links('pagination::bootstrap-4') }}
                    @endif
                </div>
                <div class="col-lg-4 pr-0">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">
                            Cras justo odio
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
