@extends('admin.layout.master')
@section('pageTitle', 'Removal Transaction')

@section('content')
    <div>
        <a href="{{ url('admin/product-add-transaction') }}" class="btn btn-outline-dark">Add Transaction</a>
        <a href="{{ url('admin/product-remove-transaction') }}" class="btn btn-dark">Remove Transaction</a>
    </div>
    <table class="table table-striped text-sm text-center">
        {{ $transactions->links() }}
        <thead>
            <tr class="row">
                <th class="col-2">Name</th>
                <th class="col-2">Image</th>
                <th class="col">Total quantity</th>
                <th class="col">Remove-Date</th>
                <th class="col-4">Description</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($transactions as $transaction)
                <tr class="row">
                    <td class="col-2 text-wrao">{{ $transaction->product->name }}</td>
                    <td class="col-2">
                        <img src="{{ asset('/images/' . $transaction->product->image) }}" class="img-thunbnail"
                            width="100px">
                    </td>
                    <td class="col">{{ $transaction->total_quantity }}</td>
                    <td class="col">{{ $transaction->created_at->format('d/m/Y') }}</td>
                    <td class="col-4">{{ $transaction->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
