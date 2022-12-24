@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Product Image')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ url('/admin/product') }}"><button class="btn btn-dark">Products</button></a>
            <hr>
            <table class="table text-center table-striped">

                <thead>
                    <tr>
                        <th class="col-3">Name</th>
                        <th class="col-6">Image</th>
                        <th class="col-3">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class='text-wrap'>{{ $product->name }}</td>
                            <td class="d-flex justify-content-between">
                                @foreach ($productImages as $productImage)
                                    @if ($product->id === $productImage->product_id)
                                        <div class="d-inline-block border bg-white m-1">
                                            <img src="{{ $productImage->image_url }}" width="160px" height="150px"
                                                class="m-1" alt="{{ $productImage->image }}">
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <button class="btn btn-dark"
                                    @foreach ($productImages as $productImage)
                                        @if ($product->id === $productImage->product_id)
                                        disabled=@isset($productImage->image)
                                        @endisset @endif @endforeach>
                                    <a href="{{ url('/admin/add-product_images/' . $product->id) }}" class="text-white">Add
                                        Images
                                    </a>
                                </button>
                                <button class="btn btn-primary">
                                    <a href="{{ url('/admin/edit-product_images/' . $product->id) }}"
                                        class="text-white">Edit
                                    </a>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
