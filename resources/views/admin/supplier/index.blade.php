@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Supplier')
@section('css')
    <style>
        .custom-img {
            width: 150px !important;
            height: 150px !important;
        }
    </style>
@endsection

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
                <th class="overflow-wrap">Description</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($suppliers as $supplier)
                <tr>
                    <td class="ps-4 col-2 overflow-wrap">{{ $supplier->name }}</td>
                    <td class="ps-4 col-4">
                        <img src="{{ asset('/images/' . $supplier->image) }}" class="img-thumbnail custom-img">
                    </td>
                    <td class="col-4 overflow-wrap">
                        {{ $supplier->description }}
                    </td>
                    <td class="col-2">
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
