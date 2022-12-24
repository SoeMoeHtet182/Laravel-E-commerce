@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Supplier')

@section('content')
    <div>
        <a href="{{ route('supplier.create') }}" class="btn btn-dark">Create Supplier</a>
    </div>
    {{ $suppliers->links() }}
    <table class="table table-striped text-dark small">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class="ps-4">{{ $supplier->name }}</td>
                    <td class="ps-4">
                        <img src="{{ asset('/images/' . $supplier->image) }}" class="img-thumbnail" width="200px">
                    </td>
                    <td>
                        {{ $supplier->description }}
                    </td>
                    <td>
                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary small">Edit</a>
                        <form action='{{ route('supplier.destroy', $supplier->id) }}' method='POST' class="d-inline">
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
