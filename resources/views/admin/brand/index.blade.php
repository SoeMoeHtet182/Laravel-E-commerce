@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Brand')

@section('content')
    <div>
        <a href="{{ route('brand.create') }}" class="btn btn-dark">Create Brand</a>
    </div>
    {{ $brands->links() }}
    <table class="table table-striped text-dark small">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($brands as $brand)
                <tr>
                    <td class="ps-4">{{ $brand->name }}</td>
                    <td class="ps-4">
                        <img src="{{ asset('/images/' . $brand->image) }}" class="img-thumbnail" width="100px">
                    </td>
                    <td>
                        <a href="{{ route('brand.edit', $brand->slug) }}" class="btn btn-primary small">Edit</a>
                        <form action='{{ route('brand.destroy', $brand->slug) }}' method='POST' class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value='Delete' class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
@endsection
