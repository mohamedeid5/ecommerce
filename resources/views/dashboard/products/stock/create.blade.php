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
                    <form method="post" action="{{ route('admin.products.stock.store') }}">
                        @csrf
                        @method('POST')
                        @include('dashboard.includes.alerts.errors')
                        @include('dashboard.includes.alerts.success')

                        <input type="hidden" name="product_id" value="{{ $id }}">

                        <div class="form-group">
                            <label for="">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control">
                        </div> <!-- end name  -->
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">Manage Stock</label>
                            <select name="manage_stock" id="manage_stock" class="select form-control">
                                <option value="1" {{ old('manage_stock', $product->manage_stock) == 1 ? 'selected' : '' }}>yes</option>
                                <option value="0" {{ old('manage_stock', $product->manage_stock) == 0 ? 'selected' : '' }}>no</option>
                            </select>
                        </div> <!-- end name  -->
                        @error('manage_stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group" style="display: none" id="qty">
                            <label for="">Quantity</label>
                            <input type="number" name="qty" value="{{ old('qty', $product->qty) }}" class="form-control">
                        </div> <!-- end name  -->
                        @error('qty')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="">In Stock</label>
                            <select name="in_stock" id="" class="select form-control">
                                <option value="1"  {{ old('in_stock', $product->in_stock) == 1 ? 'selected' : '' }}>yes</option>
                                <option value="0"  {{ old('in_stock', $product->in_stock) == 0 ? 'selected' : '' }}>no</option>
                            </select>
                        </div> <!-- end name  -->
                        @error('in_stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror


                        <button class="btn btn-primary">{{ __('general.save') }}</button>
                    </form>
                </div>
          </div>
        </div>
    </div>
@endsection


@push('js')

<script>



    if($('#manage_stock').find(':selected').val() == 1) {
        $('#qty').show();
    }

    $('#manage_stock').change(function(){

        $('#qty').toggle();

    });
</script>

@endpush
