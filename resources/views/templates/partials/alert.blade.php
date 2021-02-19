<div class="container">
@if(Session::has('success'))
    <div class="alert alert-success mt-5" role="alert">
        {{Session::get('success')}}
    </div>
@endif
@if(Session::has('danger'))
    <div class="alert alert-danger mt-5" role="alert">
        {{Session::get('danger')}}
    </div>
@endif
</div>
