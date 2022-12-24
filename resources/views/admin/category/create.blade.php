@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Category')

@section('content')
    <div>
        <a href="{{ route('category.index') }}" class="btn btn-dark">All Categories</a>
    </div>
    <hr>
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of category</label>
            <input type="text" name="name" class="form-control" />
        </div>
        <div class="form-group">
            <label for="name">Enter Myanmar name of category</label>
            <input type="text" name="mm_name" class="form-control" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
    </form>
@endsection
