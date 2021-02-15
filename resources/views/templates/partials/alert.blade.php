@if(Session::has('info'))
    <div class="alert alert-primary" role="alert">
        A simple primary alert—check it out!
        {{Session::get('info')}}
    </div>
@endif
