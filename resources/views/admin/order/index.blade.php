@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Order')
@section('css')
    <style>
        .user-info-table {
            background-color: grey;
            position: absolute;
            right: 10px;
            z-index: 999;
        }

        .user-info-table tr {
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="btn-group">
        <a class="btn btn-sm btn-dark" href="{{ url('/admin/order') }}">All</a>
        <a class="btn btn-sm btn-success" href="{{ url('/admin/order?status=success') }}">Success</a>
        <a class="btn btn-sm btn-warning" href="{{ url('/admin/order?status=pending') }}">Pending</a>
        <a class="btn btn-sm btn-danger" href="{{ url('/admin/order?status=cancel') }}">Cancel</a>
    </div>
    {{ $orders->links() }}
    <div class="row">
        <table class="table table-striped text-dark small text-center">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>User Info</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{ $order->product->image_url }}" width="80" /></td>
                        <td>{{ $order->total_quantity }}</td>
                        <td>{{ $order->total_amount }}</td>
                        <td>
                            @switch($order->status)
                                @case('success')
                                    <span class="badge bg-success">Success</span>
                                @break

                                @case('cancel')
                                    <span class="badge bg-danger">Cancel</span>
                                @break

                                @default
                                    <span class="badge bg-warning">Pending</span>
                            @endswitch

                        </td>
                        <td>
                            <div>
                                <a class="btn btn-light btn-sm" data-bs-toggle="collapse"
                                    href="#userInfo{{ $loop->iteration }}" role="button" aria-expanded="false"
                                    aria-controls="collapseExample">
                                    Display User
                                </a>
                            </div>
                            <div class="collapse user-info-table" id="userInfo{{ $loop->iteration }}">
                                <table class="table border-dark p-2">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Postal Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->user->full_name }}</td>
                                            <td><img src="{{ $order->user->image_url }}" width="50" /></td>
                                            <td>{{ $order->user->phone }}</td>
                                            <td>{{ $order->user->address }}</td>
                                            <td>{{ $order->user->postal_code }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                        <td>
                            <a href="{{ url('/admin/change-order?id=' . $order->id . '&status=success') }}"
                                class="btn btn-success btn-sm">Success</a>
                            <a href="{{ url('admin/change-order?id=' . $order->id . '&status=cancel') }}"
                                class="btn btn-danger btn-sm">Cancel</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
