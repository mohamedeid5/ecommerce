@extends('dashboard.layouts.admin')

@section('title', 'Products')

@section('content')

    <h2>Products</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-info">Add Product</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">is active</th>
            <th scope="col">created at</th>
            <th scope="col">updated at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
          <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
            <td>{{ $product->getActive() }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->updated_at }}</td>

            <td>
                <a href="{{ route('admin.products.price', $product->id) }}" class="btn btn-primary">price</a>
                <a href="{{ route('admin.products.stock', $product->id) }}" class="btn btn-primary">inventory</a>
                <a href="{{ route('admin.products.images', $product->id) }}" class="btn btn-primary">images</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">edit</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">delete</button>
                </form>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      {!! $products->links() !!}

@endsection
