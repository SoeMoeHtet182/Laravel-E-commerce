@extends('admin.layout.master');
@section('pageTitle', 'Removal of product');

@section('content')
    <h5>
        Remove For
        <b class="text-danger">{{ $product->name }}</b>
    </h5>
    <div class="my-3">
        <a href="{{ route('product.index') }}" class="btn btn-dark">All products</a>
    </div>
    <form action="{{ url('admin/product-remove/' . $product->slug) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Total quantity</label>
            <input type="number" name="total_quantity" class="form-control" />
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-danger" value="Remove">
    </form>
@endsection
