@extends('dashboard.layouts.admin')

@section('title', 'Tags')

@section('content')

    <h2>Tags</h2>

    <a href="{{ route('admin.tags.create') }}" class="btn btn-info">Add Tag</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">created at</th>
            <th scope="col">updated at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $brand)
          <tr>
            <th scope="row">{{ $brand->id }}</th>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->slug }}</td>
            <td>{{ $brand->created_at }}</td>
            <td>{{ $brand->updated_at }}</td>
            <td>
                <a href="{{ route('admin.tags.edit', $brand->id) }}" class="btn btn-primary">edit</a>
                <form action="{{ route('admin.tags.destroy', $brand->id) }}" method="post">
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
