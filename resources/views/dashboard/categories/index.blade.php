@extends('dashboard.layouts.admin')

@section('title')
    Categories
@endsection

@section('content')

    <div class="contanier">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">add new category</a>
        <!--
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin/categories.category_name') }}</th>
                <th scope="col">{{ __('admin/categories.slug') }}</th>
                <th scope="col">{{ __('admin/categories.is_active') }}</th>
                <th scope="col">{{ __('general.created_at') }}</th>
                <th scope="col">{{ __('general.updated_at') }}</th>
                <th scope="col">{{ __('general.edit') }}</th>
                <th scope="col">{{ __('general.delete') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->getActive() }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    -->

    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                @foreach($categories as $category)
                <li class="list-group-item">
                    {{ $category->name }}
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">edit</a>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">delete</button>
                    </form>
                    @if ($category->children)
                    <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                           @foreach($category->children as $child)
                           <li class="list-group-item">
                                {{ $child->name }}
                                <a href="{{ route('admin.categories.edit', $child->id) }}" class="btn btn-primary">edit</a>
                                <form action="{{ route('admin.categories.destroy', $child->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">delete</button>
                                </form>
                            </li>
                           @endforeach
                        </ul>
                    </div>
                    </div>
                    @endif

                </li>
                @endforeach
            </ul>

        </div>
      </div>



        {{ $categories->links() }}
    </div>

@endsection
