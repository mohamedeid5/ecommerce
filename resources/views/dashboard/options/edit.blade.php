@extends('dashboard.layouts.admin')
@section('title')
    add new option
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <h2 class="card-header">add new option</h5>
            <div class="card-body">
                <form method="post" action="{{ route('admin.options.update', $option->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')

                    <div class="form-group">
                        <label for="">{{ __('admin/options.option_name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $option->name) }}" class="form-control">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="">{{ __('admin/options.price') }}</label>
                        <input type="text" name="price" value="{{ old('price', $option->price) }}" class="form-control">
                    </div>
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="">Product</label>
                        <select name="product_id" id="" class="select2 custom-select">
                            <optgroup label="choose product">
                                @foreach ($data['products'] as $product)
                                <option value="{{ $product->id }}" {{ $product->id == old('product_id', $option->product_id) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('product_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Varition</label>
                        <select name="variation_id" id="" class="select2 custom-select">
                            <optgroup label="choose variation">
                                @foreach ($data['variations'] as $variation)
                                <option value="{{ $variation->id }}"
                                    {{ $variation->id == old('variation_id', $option->variation_id) ? 'selected' : '' }}
                                    >
                                        {{ $variation->name }}
                                </option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('variation_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="btn btn-primary">{{ __('admin/options.save') }}</button>
                </form>
            </div>
          </div>
    </div>
@endsection
