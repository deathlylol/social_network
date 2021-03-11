@extends('templates.default')
@section('content')
    <div class="row mt-5">
        <div class="container">
            <div class="col-lg-6 p-0">
                <h3>Результат поиска: {{ Request::input('search') }}</h3>
                @if(!$users->count())
                    <p>Пользователь не найден</p>
                @else
                    <div class="row">
                        <div class="d-flex">
                            @foreach($users as $user)
                                @include('user.partials.userblock')
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('document').ready(function () {
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
                        button.removeClass('btn-primary friend-subm').addClass('btn-success').text('Отменить запрос');
                    },
                    error: function (msg) {
                        alert('Ошибка');
                    }
                });
            });
        })
    </script>
@endpush
