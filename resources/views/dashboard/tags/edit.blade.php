@extends('dashboard.layouts.admin')
@section('title')
    {{ $tag->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">{{ $tag->name }}</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.tags.update', $tag->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <input type="hidden" name="id" value="{{ $tag->id }}">
                    <div class="form-group">
                        <label for="">{{ __('admin/tags.tag_name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $tag->name) }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/tags.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug', $tag->slug) }}" class="form-control">
                    </div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button class="btn btn-primary">{{ __('admin/tags.update') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
