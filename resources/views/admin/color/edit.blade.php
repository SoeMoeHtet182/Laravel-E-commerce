@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Color')

@section('content')
    <div>
        <a href="{{ route('color.index') }}" class="btn btn-dark">All Color</a>
    </div>
    <hr>
    <form action="{{ route('color.update', $color->slug) }}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of color</label>
            <input type="text" name="name" class="form-control" value="{{ $color->name }}" />

        </div>
        <input type="submit" value="Update" class="btn btn-primary float-end" />
    </form>
@endsection
