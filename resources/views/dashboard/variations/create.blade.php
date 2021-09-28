@extends('dashboard.layouts.admin')
@section('title')
    add new variation
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new variation</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.variations.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <div class="form-group">
                        <label for="">{{ __('admin/variation.variation_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="">{{ __('admin/variation.is_active') }}</label>
                        <select name="is_active" id="" class="custom-select">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>
                                {{ __('admin/variation.active') }}
                            </option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                {{ __('admin/variation.not_active') }}
                            </option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button class="btn btn-primary">{{ __('admin/variation.save') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
