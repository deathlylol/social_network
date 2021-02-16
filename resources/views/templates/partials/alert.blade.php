@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger" role="alert">
        {{Session::get('danger')}}
    </div>
@endif
