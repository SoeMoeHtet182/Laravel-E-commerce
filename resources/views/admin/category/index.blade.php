@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Category')

@section('content')
    <div>
        <a href="{{ route('category.create') }}" class="btn btn-dark">Create Category</a>
    </div>
    {{ $categories->links() }}
    <table class="table table-striped text-dark small">
        <thead>
            <tr>
                <th>Name</th>
                <th>MM_Name</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($categories as $category)
                <tr>
                    <td class="ps-4">{{ $category->name }}</td>
                    <td class="ps-4">{{ $category->mm_name }}</td>
                    <td>
                        <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-primary small">Edit</a>
                        <form action='{{ route('category.destroy', $category->slug) }}' method='POST' class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value='Delete' class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
