@extends('dashboard.layouts.admin')
@section('title')
    add new product
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new product</h5>
            <div class="card-content">
                <div class="card-body">
                    <form method="post" action="{{ route('admin.products.general.store') }}">
                        @csrf
                        @method('POST')
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')

                        <div class="form-group">
                            <label for="">{{ __('admin/products.product_name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div> <!-- end name  -->
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" value="{{ old('description') }}" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div> <!-- end description -->
                        @error('description')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Short Description</label>
                            <textarea class="form-control" name="short_description" value="{{ old('short_description') }}" id="exampleFormControlTextarea1" rows="2"></textarea>
                        </div>  <!-- end short description -->
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('admin/products.slug') }}</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                        </div> <!-- end slug -->
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('general.active') }}</label>
                            <select name="is_active" id="" class="custom-select">
                                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>
                                    {{ __('general.active') }}
                                </option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>
                                    {{ __('general.not_active') }}
                                </option>
                            </select> <!-- end active -->
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror


                            <div class="form-group">
                                <label for="product_id">Category</label>
                                <select class="form-control select2" multiple name="categories[]">
                                    <option value="">Select a category</option>

                                    @foreach ($data['categories'] as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ !empty(old('categories')) && in_array($cat->id, old('categories')) ? 'selected' : '' }}
                                            >{{ $cat->name }}</option>
                                        @if ($cat->children)
                                            @foreach ($cat->children as $child)
                                                <option value="{{ $child->id }}"
                                                    {{ !empty(old('categories')) && in_array($child->id, old('categories')) ? 'selected' : ''}}
                                                    >&nbsp;&nbsp;{{ $child->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div> <!-- end categories -->
                            @error('categories')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="product_id">Brand</label>
                                <select class="form-control select2" multiple name="brand_id">
                                    <option value="">Select a Brand</option>

                                    @foreach ($data['brands'] as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $brand->id == old('brand_id') ? 'selected' : '' }}
                                            >{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div> <!-- end brands -->
                            @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            <div class="form-group">
                                <label for="product_id">Tags</label>
                                <select class="form-control select2" multiple name="tags[]">
                                    <option value="">Select a Tag</option>

                                    @foreach ($data['tags'] as $tag)
                                        <option value="{{ $tag->id }}"
                                            {{ !empty(old('tags')) && in_array($tag->id, old('tags')) ? 'selected' : ''}}
                                            >{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div> <!-- end tags -->
                            @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        <button class="btn btn-primary">{{ __('general.save') }}</button>
                    </form>
                </div>
          </div>
        </div>
    </div>
@endsection
