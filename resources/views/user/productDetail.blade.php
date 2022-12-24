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
    <div id="root"></div>
@endsection
@section('script')
    <script>
        window.product_slug = "{{ $slug }}";
    </script>
    <script src="{{ mix('js/productDetail.js') }}"></script>
@endsection
