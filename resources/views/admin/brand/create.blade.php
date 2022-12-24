@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Brand')

@section('content')
    <div>
        <a href="{{ route('brand.index') }}" class="btn btn-dark">All Brands</a>
    </div>
    <hr>
    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of brand</label>
            <input type="text" name="name" class="form-control" />
        </div>
        <div class="form-group">
            <label for="name">Enter image of brand</label>
            <input type="file" name="image" class="form-control" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
    </form>
@endsection
