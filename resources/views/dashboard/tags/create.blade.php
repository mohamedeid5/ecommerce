@extends('dashboard.layouts.admin')
@section('title')
    add new tag
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new tag</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.tags.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <div class="form-group">
                        <label for="">{{ __('admin/tags.tag_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/tags.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                    </div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror


                    <button class="btn btn-primary">{{ __('admin/tags.save') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
