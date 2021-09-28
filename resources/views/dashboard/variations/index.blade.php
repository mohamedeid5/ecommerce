@extends('dashboard.layouts.admin')

@section('title', 'Variations')

@section('content')

    <h2>Variations</h2>

    <a href="{{ route('admin.variations.create') }}" class="btn btn-info">Add Brand</a>

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
          @foreach($variations as $variation)
          <tr>
            <th scope="row">{{ $variation->id }}</th>
            <td>{{ $variation->name }}</td>

            <td>{{ $variation->created_at }}</td>
            <td>{{ $variation->updated_at }}</td>
            <td>
                <a href="{{ route('admin.variations.edit', $variation->id) }}" class="btn btn-primary">edit</a>
                <form action="{{ route('admin.variations.destroy', $variation->id) }}" method="post">
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
