@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Income')

@section('content')
    <div>
        <a href="{{ route('income.create') }}" class="btn btn-dark">Create Income</a>
        <button class="btn btn-outline-warning">Today Income : {{ $todayIncome }} $</button>
    </div>
    {{ $income->links() }}
    <table class="table table-striped text-dark small text-center">
        <thead>
            <tr class="row">
                <th class="col-2">Title</th>
                <th class="col-2">Amount</th>
                <th class="col-4">Description</th>
                <th class="col-2">Date</th>
                <th class="col-2">Option</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($income as $i)
                <tr class="row">
                    <td class="ps-4 col-2 text-wrap">{{ $i->title }}</td>
                    <td class="ps-4 col-2">{{ $i->amount }} $</td>
                    <td class="ps-4 col-4 text-wrap text-start">{{ $i->description }}</td>
                    <td class="ps-4 col-2">{{ $i->created_at->format('d/m/Y') }}</td>
                    <td class="ps-4 col-2">
                        <a href="{{ route('income.edit', $i->id) }}" class="btn btn-primary small">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
