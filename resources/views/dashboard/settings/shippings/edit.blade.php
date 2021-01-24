@extends('dashboard.layouts.admin')
@section('title')
    {{ $method->value }}
@endsection

@section('content')
    <div class="container">
    <form method="post" action="{{ route('admin.update.shipping.methods', $method->id) }}">
        @csrf
        @method('PUT')
        <div class="form-check">

            <label class="form-check-label" for="status">{{ __('settings.status') }}</label>
            <input type="checkbox"  style="position: absolute;right: 77px;" class="form-check-input" id="status">
        </div>
        <div class="form-group">
            <label for="key">{{ __('settings.label') }}</label>
            <input type="text" class="form-control" id="key" value="{{ $method->value }}" aria-describedby="key" placeholder="key">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">{{ __('settings.amount') }}</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="amount">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('settings.save') }}</button>
    </form>
    </div>
@endsection
