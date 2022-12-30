@extends('user.layout.master')
@section('style')
    <style>
        .card {
            width: '10rem';
            text-overflow: 'ellipsis',
        }

        .card-img-div {
            text-align: center;
            margin-bottom: 10px
        }

        .card-text {
            color: black
        }

        option {
            color: black
        }

        .discount {
            text-decoration: line-through black 2px;
        }
    </style>
@endsection
@section('content')
    <div class='contaier mb-5'>
        <!-- Page Content -->
        <!-- Items Starts Here -->
        <div class="featured-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                    </div>
                    <div class="col-sm-12">
                        <div id="filters" class="button-group">
                            <form action="" class="d-inline-block">
                                <input type="hidden" name="product" id="product" />
                                <button
                                    class='btn btn-primary {{ Str::contains(url()->full(), 'all') ? 'text-primary' : '' }}'
                                    onclick="productFunction('all')">
                                    {{ __('site.all_products') }}
                                </button>
                                <button
                                    class="btn btn-primary {{ Str::contains(url()->full(), 'new') ? 'text-primary' : '' }}"
                                    onclick="productFunction('new')">
                                    {{ __('site.new') }}
                                </button>
                            </form>
                            <form action="" class="d-inline-block">
                                <select name="category" class="btn btn-primary">
                                    <option value="">{{ __('site.category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->slug }}">
                                            {{ app()->getLocale() === 'mm' ? $category->mm_name : $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="brand" class="btn btn-primary">
                                    <option value="">{{ __('site.brand') }}</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <a id='search-btn' href="{{ url('/products') }}"
                                    class='btn btn-dark float-end'>{{ __('site.clear') }}</a>
                                <input id="clear-btn" type="submit" class="btn btn-dark me-1 float-end"
                                    value="{{ __('site.search') }}" />
                                <div id="search-bar" class="input-group float-end ms-2" style="width: 200px">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="search"
                                        placeholder="{{ __('site.type_here') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured container no-gutter">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="section-heading mt-0">
                        <div class="line-dec"></div>
                        <h1>{{ __('site.featured') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div id="{{ $product->id }}" class="col-md-4">
                        <a href="{{ url('/products/detail/' . $product->slug) }}">
                            <div class='card p-3 m-2'>
                                <div class="card-img-div">
                                    <img src="{{ $product->image_url }}" style="width: 100%; height: 235px" />
                                </div>
                                <div class='card-body'>
                                    <h6 class='card-text text-nowrap overflow-hidden'>{{ $product->name }}</h6>
                                    @if ($product->discount_price == 0)
                                        <h6 class='mt-2 text-primary'>$ {{ $product->sale_price }}</h6>
                                    @else
                                        <h6 class='d-inline discount'>$ {{ $product->sale_price }}</h6>
                                        <h6 class="d-inline">
                                            ${{ $product->sale_price - $product->discount_price }}
                                            <b class="text-danger ms-1">
                                                {{ number_format(($product->discount_price / $product->sale_price) * 100, 0) }}
                                                % off
                                            </b>
                                        </h6>
                                    @endif
                                    <div class="mt-2 text-black">
                                        <div class='d-inline me-2'><i class="fa-solid fa-eye"></i>
                                            {{ $product->view_count }} </div>
                                        <div class='d-inline'>
                                            <i class="fa-regular fa-heart me-1"></i>{{ $product->like_count }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="page-navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- Featred Page Ends Here -->
    </div>
@endsection
@section('script')
    <script>
        function productFunction(type) {
            document.getElementById("product").value = type;
        }
    </script>
@endsection
