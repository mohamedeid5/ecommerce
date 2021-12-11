@extends('site.layouts.site')

@section('content')

<div class="container">

    <h2>{{ $category->name }} ({{ count($products) }}) </h2>

    @if(count($products) > 0)

    <div class="row">
            @foreach ($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">

            <div class="single-product">
                <div class="product-img">
                    <a href="product-details.html">
                        <img class="default-img" src="{{ Storage::url('admin/images/products/'.$product->id.'/'.$product->images->first()->image) }}" alt="#">
                        <img class="hover-img" src="{{ Storage::url('admin/images/products/'.$product->id.'/'.$product->images->first()->image) }}" alt="#">
                    </a>
                    <div class="button-head">
                        <div class="product-action">
                            <a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
                            <a title="Wishlist" class="addToWishList" data-product-id="{{ $product->id }}" href="{{ route('wishlist.store', $product->id) }}">
                                <i class="far fa-heart {{ auth()->user()->wishlistHas($product->id) ? ' fw-900' : '' }}  product-{{ $product->id }}"></i>
                                <span class="addToWishlistMessage-{{ $product->id }}">{{ auth()->user()->wishlistHas($product->id) ? 'remove from wish list' : 'add to wishlist' }}</span>
                            </a>
                            <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
                        </div>
                        <div class="product-action-2">
                                @if($product->in_stock)
                                    <a title="Add to cart" href="#">Add to cart</a>
                                @else
                                    <span style="color: red">Out of stock</span>
                                @endif

                        </div>
                    </div>
                </div>
                <div class="product-content">
                    <h3><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                    <div class="product-price">
                        <span>{{ $product->speical_price ?? $product->price }}$</span>

                        @if($product->speical_price)
                            <del>{{  $product->price }}$</del>
                        @endif
                    </div>
                </div>
            </div>
        </div>

            @endforeach
    </div>
    @else
    <h3>there is no products to show.</h3>
    @endif
</div>

@endsection
