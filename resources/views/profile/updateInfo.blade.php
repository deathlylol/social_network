@extends('templates.default')
@section('content')
    <div class="row mt-5">
        <div class="container">
            <div class="col-lg-6">
                <form action="{{route('profile.update',['id' => $user->id])}}" method="POST" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="location">Изменить город проживания</label>
                        <input name="location" class="form-control" type="text" placeholder="{{!empty($user->location) ? $user->location : 'город'}}" id="location">
                    </div>
                    <div class="form-group">
                        <label for="school">Образование</label>
                        <input name="school" class="form-control" type="text" placeholder="{{!empty($user->school) ? $user->school : 'образование'}}" id="school">
                    </div>
                    <div class="form-group">
                        <label for="job">Работа</label>
                        <input name="job" class="form-control" type="text" placeholder="{{!empty($user->job) ? $user->job : 'работа'}}" id="job">
                    </div>
                    <button type="submit" class="btn btn-primary">Применить измения</button>
                </form>
            </div>
        </div>
    </div>
@endsection
