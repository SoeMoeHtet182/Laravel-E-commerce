@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Product')
@section('css')
    <style>
        .product .img-thumbnail {
            width: 180px;
            height: 160px;
        }
    </style>
@endsection

@section('content')
    <div class="d-inline me-2">
        <a href="{{ route('product.create') }}" class="btn btn-dark">Create Product</a>
    </div>
    <div class="d-inline">
        <a href="{{ url('/admin/product_images') }}" class="btn btn-dark">Product Images</a>
    </div>
    {{ $products->links() }}
    <table class="table table-striped text-dark small text-center">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Total_quantity</th>
                <th>Add or Remove</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($products as $product)
                <tr class="product">
                    <td class="ps-4">{{ $product->name }}</td>
                    <td class="ps-4">
                        <img src="{{ asset('/images/' . $product->image) }}" class="img-thumbnail" />
                    </td>
                    <td class="ps-4">{{ $product->total_quantity }}</td>
                    <td>
                        <a href="{{ url('/admin/product-add/' . $product->slug) }}" class="btn btn-warning">+</a>
                        <a href="{{ url('/admin/product-remove/' . $product->slug) }}" class="btn btn-warning">-</a>
                    </td>
                    <td>
                        <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-primary small">Edit</a>
                        <form action='{{ route('product.destroy', $product->slug) }}' method='POST' class="d-inline"
                            onsubmit="return confirm('Are you sure to delete')">
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
