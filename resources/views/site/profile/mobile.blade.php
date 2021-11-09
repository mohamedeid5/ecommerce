@extends('site.layouts.site')
@section('title')
    {{ auth()->user()->name }}
@endsection

@section('content')

<div class="row">
    <div class="col-md-6">
        @include('site.includes.profile-sidebar')
    </div>
    <div class="col-md-4">
        <div class="card-content collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

                        @if(auth()->user()->mobile)
                            <p>your mobile phone: {{ auth()->user()->mobile }}</p>
                        @else
                            <p>you don t have mobile phone yet.</p>
                        @endif

                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')
                        <form method="post" action="{{ route('profile.mobile.send.code') }}" id="sendCode">
                            @csrf
                             @method('post')
                            <div class="form-group">
                                <label for="key">Mobile</label>
                                <input type="text" class="form-control" name="mobile" id="key" value="{{ session('mobile') }}" aria-describedby="key" placeholder="mobile">

                                @error('mobile')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary" id="">send code</button>
                        </form>

                        <form method="post" action="{{ route('profile.mobile.recive.code') }}" style="display: none" id="reciveCode">
                            @csrf
                             @method('post')
                            <div class="form-group">
                                <label for="key">Code</label>
                                <input type="text" class="form-control" name="code" id="key" value="{{ old('code') }}" aria-describedby="key" placeholder="code">

                                @error('code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')

   <script>
    $(function(){





        $('#sendCode').submit(function(e) {
            e.preventDefault();

            var form = $(this);

            var url = form.attr('action')

            $.ajax({

                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(data) {
                    $.each(data, function(key, value) {
                        console.log(value[0]);
                        $('#sendCode').append('<p class="alert alert-danger">'+ value[0] + '</p>');
                    });
                    console.log('success');

                },
                error: function(data) {
                    $("button:contains('send code')").click(function() {
                        $(this).text('send again');
                        $('#reciveCode').show();
                    });
                }
            });

        });

    });
   </script>

@endpush
