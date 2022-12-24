@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Outcome')

@section('content')
    <div>
        <a href="{{ route('outcome.index') }}" class="btn btn-dark">All Outcomes</a>
    </div>
    <hr>
    <form action="{{ route('outcome.update', $outcome->id) }}" method="POST">
        @csrf
        @method('PUT')
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="form-group">
            <label for="title">Enter title</label>
            <input type="text" name="title" class="form-control" value="{{ $outcome->title }}" />
        </div>
        <div class="form-group">
            <label for="amount">Enter amount</label>
            <input type="number" name="amount" class="form-control" value="{{ $outcome->amount }}" />
        </div>
        <div class="form-group">
            <label for="description">Enter description</label>
            <textarea name="description" cols="30" rows="10" class="form-control">{{ $outcome->description }}</textarea>
        </div>
        <input type="submit" value="Update" class="btn btn-primary float-end" />
    </form>
@endsection
