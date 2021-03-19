@if(Session::has('success'))
    <div class="container">
        <div class="alert alert-success mt-5" role="alert">
            {{Session::get('success')}}
        </div>
    </div>
@endif
@if(Session::has('danger'))
    <div class="container">
        <div class="alert alert-danger mt-5" role="alert">
            {{Session::get('danger')}}
        </div>
    </div>
@endif
