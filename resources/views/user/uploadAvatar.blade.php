@extends('templates.default')
@section('content')
    <div class="container mt-5">
        <h1>Загрузите вашу аватарку</h1>
        <div class="col-lg-3 p-0">
            <form action="{{ route('user.upload-avatar',['id' => $user->id]) }}" method="POST" enctype="multipart/form-data"
                  novalidate>
                @csrf
                <div class="d-flex align-items-start">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend d-flex align-items-center">
                            @if($errors->has('avatar'))
                                <label class="custom-file-label {{$errors->has('avatar') ? 'text-danger': ''}}"
                                       for="inputGroupFile01">{{$errors->first('avatar')}}</label>
                            @else
                                <label class="custom-file-label" for="inputGroupFile01">
                                    Загрузить
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
                                    </svg>
                                </label>
                            @endif
                        </div>
                        <div class="custom-file">
                            <input class="custom-file-input {{$errors->has('avatar') ? 'is-invalid': ''}}" type="file" id="formFile" name="avatar">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>

            </form>
        </div>
    </div>
@endsection
