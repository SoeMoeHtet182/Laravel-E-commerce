@extends('admin.layout.master')
@section('pageTitle', 'Transaction')

@section('content')
    <h5>
        Add For
        <b class="text-danger">{{ $product->name }}</b>
    </h5>
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All products</a>
    </div>
    <form action="{{ url('admin/product-add/' . $product->slug) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Supplier Name</label>
            <select name="supplier_id" class="form-control">
                @foreach ($supplier as $s)
                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Enter Total quantity</label>
            <input type="number" name="total_quantity" class="form-control" />
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Add">
    </form>
@endsection
