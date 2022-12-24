@extends('user.layout.master')
@section('style')
    <style>
        #root {
            margin: 50px 0;
        }

        @media(max-width:991px) {
            #root {
                margin-top: 0;
            }
        }
    </style>
@endsection
@section('content')
    @include('user.layout.banner')
    <div id="root"></div>
@endsection

@section('script')
    <script src="{{ mix('js/home.js') }}"></script>
@endsection
