@extends('dashboard.layouts.admin')
@section('title')
    {{ $method->value }}
@endsection

@section('content')
    <div class="container">
        <div class="card-content collapse show">
            <div class="card-body">
            <div class="row">
                <div class="col-md-6">


        @include('dashboard.includes.alerts.errors')
        @include('dashboard.includes.alerts.success')
                <form method="post" action="{{ route('admin.update.shipping.methods', $method->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="key">{{ __('admin/settings.label') }}</label>
                        <input type="text" class="form-control" name="value" id="key" value="{{ old('value', $method->value) }}" aria-describedby="key" placeholder="key">
                        @error('value')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">{{ __('admin/settings.amount') }}</label>
                        <input type="number" name="plain_value" class="form-control" value="{{ old('plain_value', $method->plain_value) }}" id="exampleInputPassword1" placeholder="amount">
                    </div>
                    @error('plain_value')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary">{{ __('admin/settings.save') }}</button>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
