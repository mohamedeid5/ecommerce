@extends('dashboard.layouts.admin')
@section('title')
    add new brand
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new brand</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <div class="form-group">
                        <label for="">{{ __('admin/brands.brand_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/brands.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                    </div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/brands.is_active') }}</label>
                        <select name="is_active" id="" class="custom-select">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>
                                {{ __('admin/brands.active') }}
                            </option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                {{ __('admin/brands.not_active') }}
                            </option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">{{ __('admin/brands.image') }}</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary">{{ __('admin/brands.save') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
