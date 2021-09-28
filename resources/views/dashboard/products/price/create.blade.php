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
                    <form method="post" action="{{ route('admin.products.price.store') }}">
                        @csrf
                        @method('POST')
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')

                        <input type="hidden" name="product_id" value="{{ $id }}">

                        <div class="form-group">
                            <label for="">{{ __('admin/products.product_price') }}</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control">
                        </div> <!-- end name  -->
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('admin/products.special_price') }}</label>
                            <input type="number" name="speical_price" value="{{ old('speical_price', $product->speical_price) }}" class="form-control">
                        </div> <!-- end name  -->
                        @error('speical_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('admin/products.speical_price_type') }}</label>
                            <select name="speical_price_type" id="" class="select form-control">
                                <option value="percent" {{ $product->speical_price_type == 'percent' ? 'selected' : '' }} >{{ __('admin/products.precent') }}</option>
                                <option value="fixed" {{ $product->speical_price_type == 'fixed' ? 'selected' : '' }}>{{ __('admin/products.fixed') }}</option>
                            </select>
                        </div> <!-- end name  -->
                        @error('speical_price_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('admin/products.speical_price_start') }}</label>
                            <input type="date" name="speical_price_start" value="{{ old('speical_price_start', date('Y-m-d' , strtotime($product->speical_price_start))) }}" class="form-control">
                        </div> <!-- end slug -->
                        @error('speical_price_start')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">{{ __('admin/products.speical_price_end') }}</label>
                            <input type="date" name="speical_price_end" value="{{ old('speical_price_end', date('Y-m-d' , strtotime($product->speical_price_end))) }}" class="form-control">
                        </div> <!-- end slug -->
                        @error('speical_price_end')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <button class="btn btn-primary">{{ __('general.save') }}</button>
                    </form>
                </div>
          </div>
        </div>
    </div>
@endsection
