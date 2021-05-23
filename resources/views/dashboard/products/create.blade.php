@extends('dashboard.layouts.admin')
@section('title')
    add new Product
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new Product</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.products.store') }}">
                    @csrf
                    @method('POST')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')
                    <div class="form-group">
                        <label for="">{{ __('admin/products.product_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/products.slug') }}</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                    </div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="">{{ __('admin/products.is_active') }}</label>
                        <select name="is_active" id="" class="custom-select">
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>
                                {{ __('admin/products.active') }}
                            </option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                {{ __('admin/products.not_active') }}
                            </option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <div class="form-group">
                            <label for="product_id">Category</label>
                            <select class="form-control " name="parent_id">
                                <option value="">Select a product</option>

                                @foreach ($products as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $cat->id == old('parent_id') ? 'selected' : '' }}
                                        >{{ $cat->name }}</option>
                                    @if ($cat->children)
                                        @foreach ($cat->children as $child)
                                            <option value="{{ $child->id }}"
                                                {{ $child->id == old('parent_id') ? 'selected' : '' }}
                                                >&nbsp;&nbsp;{{ $child->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    <button class="btn btn-primary">{{ __('admin/products.save') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
