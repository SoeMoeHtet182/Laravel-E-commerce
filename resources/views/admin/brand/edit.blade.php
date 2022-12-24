@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Brand')

@section('content')
    <div>
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brands</a>
    </div>
    <hr>
    <form action="{{ route('brand.update', $brand->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of brand</label>
            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" />
        </div>
        <div class="form-group">
            <label for="image">Enter image of brand</label>
            <input type="file" name="image" class="form-control" />
            <img src="{{ asset('/images/' . $brand->image) }}" class="img-thumbnail" style="width: 100px" />
        </div>
        <input type="submit" value="Update" class="btn btn-primary" />
    </form>
@endsection
