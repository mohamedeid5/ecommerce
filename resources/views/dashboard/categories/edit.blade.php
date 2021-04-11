@extends('dashboard.layouts.admin')
@section('title')
    {{ $category->name }}
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">{{ $category->name }}</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.categories.update', $category->id) }}">
                    @csrf
                    @method('put')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <div class="form-group">
                        <label for="">{{ __('admin/categories.category_name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/categories.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="form-control">
                    </div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/categories.is_active') }}</label>
                        <select name="is_active" id="" class="custom-select">
                            <option value="1" {{ $category->is_active == 1 ? 'selected' : '' }}>
                                {{ __('admin/categories.active') }}
                            </option>
                            <option value="0" {{ $category->is_active == 0 ? 'selected' : '' }}>
                                {{ __('admin/categories.not_active') }}
                            </option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="parent_id">
                            <option value="">Select a Category</option>

                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ $cat->id == old('parent_id', $category->id) ? 'selected' : '' }}
                                    >{{ $cat->name }}</option>
                                @if ($cat->children)
                                    @foreach ($cat->children as $child)
                                        <option value="{{ $child->id }}"
                                            {{ $child->id == old('parent_id', $category->id) ? 'selected' : '' }}
                                            >&nbsp;&nbsp;{{ $child->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-primary">{{ __('admin/categories.update') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
