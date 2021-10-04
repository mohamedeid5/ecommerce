@extends('dashboard.layouts.admin')

@section('title', 'Variations')

@section('content')

    <h2>Options</h2>

    <a href="{{ route('admin.options.create') }}" class="btn btn-info">Add Option</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Product</th>
            <th scope="col">Varition</th>
            <th scope="col">created at</th>
            <th scope="col">updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($options as $option)
            <tr>
                <th scope="row">{{ $option->id }}</th>
                <td>{{ $option->name }}</td>
                <td>{{ $option->product->name }}</td>
                <td>{{ $option->variation->name }}</td>
                <td>{{ $option->created_at }}</td>
                <td>{{ $option->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.options.edit', $option->id) }}" class="btn btn-primary">edit</a>
                    <form action="{{ route('admin.options.destroy', $option->id) }}" method="post">
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
