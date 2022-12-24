@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Category')

@section('content')
    <div>
        <a href="{{ route('category.index') }}" class="btn btn-dark">All Categories</a>
    </div>
    <hr>
    <form action="{{ route('category.update', $category->slug) }}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of Category</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}" />
        </div>
        <div class="form-group">
            <label for="name">Enter Myanmar name of category</label>
            <input type="text" name="mm_name" class="form-control" value="{{ $category->mm_name }}" />
        </div>
        <input type="submit" value="Update" class="btn btn-primary float-end" />
    </form>
@endsection
