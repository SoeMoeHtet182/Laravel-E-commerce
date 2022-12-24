@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Supplier')

@section('content')
    <div>
        <a href="{{ route('supplier.index') }}" class="btn btn-dark">All Suppliers</a>
    </div>
    <hr>
    <form action="{{ route('supplier.update', $supplier->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of supplier</label>
            <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" />
        </div>
        <div class="form-group">
            <label for="image">Enter image of supplier</label>
            <input type="file" name="image" class="form-control" />
            <img src="{{ asset('/images/' . $supplier->image) }}" class="img-thumbnail" style="width: 100px" />
        </div>
        <div class="form-group">
            <label for="">Enter Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <input type="submit" value="Update" class="btn btn-primary" />
    </form>
@endsection
