@extends('site.layouts.site')
@section('title')
    {{ $user->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card-content collapse show">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">


                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')
                        <form method="post" action="{{ route('user.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="key">{{ __('general.name') }}</label>
                                <input type="text" class="form-control" name="name" id="key" value="{{ old('name', $user->name) }}" aria-describedby="key" placeholder="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{ __('general.email') }}</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" id="exampleInputPassword1" placeholder="email">
                            </div>
                            @error('email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror


                            <div class="form-group">
                                <label for="exampleInputPassword1">{{ __('general.password') }}</label>
                                <input type="password" name="password" class="form-control" value="" id="exampleInputPassword1" placeholder="password">
                            </div>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="form-group">
                                <label for="exampleInputPassword1">{{ __('general.password_confirmation') }}</label>
                                <input type="password" name="password_confirmation" class="form-control" value="" id="exampleInputPassword1" placeholder="new password">
                            </div>
                            @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <button type="submit" class="btn btn-primary">{{ __('general.save') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('css')

<style>
    .main-category {
        display: none;
    }
</style>

@endpush
