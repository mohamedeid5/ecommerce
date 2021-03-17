@if(Session::has('success'))

    <div class="row mr-2 ml-2">
        <span class="alert-success">{{ Session::get('success') }}</span>
    </div>

@endif
