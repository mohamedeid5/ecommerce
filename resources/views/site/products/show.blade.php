@extends('site.layouts.site')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
           @if(count($product->images) > 0)
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{ Storage::url('admin/images/products/' . $product->id . '/' . $product->images->first()->image) }}">
                        </div>
                        @foreach ($product->images as $image)
                        <div class="item">
                            <img src="{{ Storage::url('admin/images/products/' . $product->id . '/' . $image->image) }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            <div class="clearfix">
                <div id="thumbcarousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        <div class="item active">
                            @foreach ($product->images->take(4) as $index => $image)
                            <div data-target="#carousel" data-slide-to="{{ $index + 1 }}" class="thumb"><img src="{{ Storage::url('admin/images/products/' . $product->id . '/' . $image->image) }}"></div>
                            @endforeach
                        </div><!-- /item -->
                        <div class="item">
                            @foreach ($product->images->skip(4) as $index => $image)
                            <div data-target="#carousel" data-slide-to="{{ $index + 1 }}" class="thumb"><img src="{{ Storage::url('admin/images/products/' . $product->id . '/' . $image->image) }}"></div>
                            @endforeach
                        </div><!-- /item -->
                    </div><!-- /carousel-inner -->
                    <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div> <!-- /thumbcarousel -->
            </div><!-- /clearfix -->

           @endif
        </div>
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>
            <span>{{ $product->speical_price ?? $product->price }}</span>
            @if ($product->speical_price)
                <del>{{ $product->price  }}</del>
            @endif
            <p>{{ $product->description }}</p>
            <span>categories: </span>
            @foreach ($product->categories as $category)
                <span>{{ $category->name }}</span>
            @endforeach
            <br>
            <span>tags: </span>
            @foreach ($product->tags as $tag)
                <span>{{ $tag->name }}</span>
            @endforeach
            <br>
            <span>Availability: </span>
            <span>{{ $product->in_stock == true ? 'in stock' : 'out of stock' }}</span>
            <br>
            <span>quantity</span> <br>
            <input type="number" class="form-group input-number" value="1" min="1" max="{{ $product->qty }}" name="qty">

            <div class="cart mt-4 align-items-center">
                <button class="btn btn-danger text-uppercase mr-2 px-4">Add to cart</button>
                <i class="fa fa-heart text-muted"></i>
                <i class="fa fa-share-alt text-muted"></i>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')

<style>
/* CSS used here will be applied after bootstrap.css */
.carousel {
    margin-top: 20px;
}
.item .thumb {
	width: 25%;
	cursor: pointer;
	float: left;
}
.item .thumb img {
	width: 100%;
	margin: 2px;
}
.item img {
	width: 100%;
}
</style>

@endpush
