@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Income')

@section('content')
    <div>
        <a href="{{ route('income.index') }}" class="btn btn-dark">All Incomes</a>
    </div>
    <hr>
    <form action="{{ route('income.store') }}" method="POST">
        @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="form-group">
            <label for="title">Enter title</label>
            <input type="text" name="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="amount">Enter amount</label>
            <input type="number" name="amount" class="form-control" />
        </div>
        <div class="form-group">
            <label for="description">Enter description</label>
            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="submit" value="Create" class="btn btn-primary float-end" />
    </form>
@endsection
