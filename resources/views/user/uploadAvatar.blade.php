@extends('templates.default')
@section('content')
    <h1>Загрузите вашу аватарку</h1>
    <div class="col-lg-3">
        <form action="{{ route('user.update',['id' => $user->id]) }}" method="POST" enctype="multipart/form-data"
              novalidate>
            @csrf
            <div class="d-flex flex-column align-items-start">
                <div class="mb-3">
                    @if($errors->has('avatar'))
                        <label for="formFile" class="form-label text-danger">{{$errors->first('avatar')}}</label>
                    @else
                        <label for="formFile" class="form-label">Выберите изображение</label>
                    @endif
                    <input class="form-control {{$errors->has('avatar') ? 'is-invalid': ''}}" type="file" id="formFile"
                           name="avatar">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
