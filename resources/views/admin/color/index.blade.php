@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Color')

@section('content')
    <div>
        <a href="{{ route('color.create') }}" class="btn btn-dark">Create Color</a>
    </div>
    {{ $colors->links() }}
    <table class="table table-striped text-dark small">
        <thead>
            <tr>
                <th>Name</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($colors as $color)
                <tr>
                    <td class="ps-4">{{ $color->name }}</td>
                    <td>
                        <a href="{{ route('color.edit', $color->slug) }}" class="btn btn-primary small">Edit</a>
                        <form action='{{ route('color.destroy', $color->slug) }}' method='POST' class="d-inline">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value='Delete' class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
