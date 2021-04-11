@extends('dashboard.layouts.admin')

@section('title', 'Brands')

@section('content')

    <h2>Brands</h2>

    <a href="{{ route('admin.brands.create') }}" class="btn btn-info">Add Brand</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Slug</th>
            <th scope="col">created at</th>
            <th scope="col">updated at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($brands as $brand)
          <tr>
            <th scope="row">{{ $brand->id }}</th>
            <td>{{ $brand->name }}</td>
            <td>
                <img src="{{ Storage::url($brand->image) }}" style="width: 50px;height:50px;" alt="">

            </td>
            <td>{{ $brand->slug }}</td>
            <td>{{ $brand->created_at }}</td>
            <td>{{ $brand->updated_at }}</td>
            <td>
                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-primary">edit</a>
                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">delete</button>
                </form>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

@endsection
