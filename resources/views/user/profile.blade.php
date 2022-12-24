@extends('user.layout.master')
@section('style')
    <style>
        #root {
            margin-top: 50px;
            padding-top: 30px;
            background: linear-gradient(to right, rgba(251, 194, 235, 1), rgba(166, 193, 238, 1));
        }

        .breadcrumb-item a {
            color: rgb(234, 14, 175);
        }

        .breadcrumb .active a {
            color: #011b8d;
        }
    </style>
@endsection
@section('content')
    <div id='root'></div>
@endsection
@section('script')
    <script src="{{ mix('js/profile.js') }}"></script>
@endsection
