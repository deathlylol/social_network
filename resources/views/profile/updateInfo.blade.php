@extends('templates.default')
@section('content')
    <div class="row mt-5">
        <div class="container">
            <div class="col-lg-6">
                <form action="{{route('profile.update',['id' => $user->id])}}" method="POST" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="location">Изменить город проживания</label>
                        <input name="location" class="form-control" type="text" placeholder="город" id="location" value="{{!empty($user->location) ? $user->location : 'город'}}">
                    </div>
                    <div class="form-group">
                        <label for="school">Образование</label>
                        <input name="school" class="form-control" type="text" placeholder="образование" id="school" value="{{!empty($user->school) ? $user->school : 'образование'}}">
                    </div>
                    <div class="form-group">
                        <label for="job">Работа</label>
                        <input name="job" class="form-control" type="text" placeholder="работа" id="job" value="{{!empty($user->job) ? $user->job : 'работа'}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Применить измения</button>
                </form>
            </div>
        </div>
    </div>
@endsection
