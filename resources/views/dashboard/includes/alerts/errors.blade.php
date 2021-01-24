@if(Session::has('error'))

    <div class="row mr-2 ml-2">
        <span class="alert-danger">{{ Session::get('error') }}</span>
    </div>

@endif
