@extends('admin.layout.master')
@section('pageTitle', 'Add Transaction')

@section('content')
    <div>
        <a href="{{ url('admin/product-add-transaction') }}" class="btn btn-dark">Add Transaction</a>
        <a href="{{ url('admin/product-remove-transaction') }}" class="btn btn-outline-dark">Remove Transaction</a>
    </div>
    <table class="table table-striped text-sm text-center">
        {{ $transactions->links() }}
        <thead>
            <tr class="row">
                <th class="col">Name</th>
                <th class="col-2">Image</th>
                <th class="col">Supplier</th>
                <th class="col">Total quantity</th>
                <th class="col">Buy-Date</th>
                <th class="col-3">Description</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($transactions as $transaction)
                <tr class="row">
                    <td class="col text-wrap">{{ $transaction->product->name }}</td>
                    <td class="col-2">
                        <img src="{{ asset('/images/' . $transaction->product->image) }}" class="img-thunbnail"
                            width="100px">
                    </td>
                    <td class="col">
                        @foreach ($suppliers as $supplier)
                            @if ($supplier->id == $transaction->supplier_id)
                                {{ $supplier->name }}
                            @endif
                        @endforeach
                    </td>
                    <td class="col">{{ $transaction->total_quantity }}</td>
                    <td class="col">{{ $transaction->created_at->format('d/m/Y') }}</td>
                    <td class="col-3 text-wrap">{{ $transaction->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
