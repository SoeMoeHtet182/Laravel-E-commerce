@extends('admin.layout.master')
@section('pageTitle', 'User List')
@section('content')
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Image</th>
                <th>Status</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->display_name }}</td>
                    <td><img src="{{ $user->image_url }}" alt="" width="100px"></td>
                    <td>
                        @if ($user->suspended == 0)
                            <div class="btn btn-sm btn-outline-success">Active</div>
                        @else
                            <div class="btn btn-sm btn-outline-danger">Suspedend</div>
                        @endif
                    </td>
                    <td>
                        <form action="{{ url('/admin/manage_user/' . $user->id) }}" method="POST" class="d-inline"
                            id="manage-user">
                            @csrf
                            @if ($user->suspended == 0)
                                <a class="btn btn-sm btn-danger manage-user"><input type="text" hidden name="type"
                                        value="ban">Ban</a>
                            @else
                                <a class="btn btn-sm btn-success manage-user"><input type="text" hidden name="type"
                                        value="release">Release</a>
                            @endif
                        </form>
                        <form action="{{ url('/admin/manage_user/' . $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="type" class="btn btn-sm btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('script')
    <script>
        $('.manage-user').click(() => {
            $('#manage-user').submit();
        })
    </script>
@endsection
