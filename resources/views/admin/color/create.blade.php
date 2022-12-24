@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Color')

@section('content')
    <div>
        <a href="{{ route('color.index') }}" class="btn btn-dark">All Colors</a>
    </div>
    <hr>
    <form action="{{ route('color.store') }}" method="POST">
        @csrf
        @if ($errors->has('name'))
            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group">
            <label for="name">Enter name of color</label>

            <input type="text" name="name" class="form-control" />
        </div>
        <input type="submit" value="Create" class="btn btn-primary" />
    </form>
@endsection
