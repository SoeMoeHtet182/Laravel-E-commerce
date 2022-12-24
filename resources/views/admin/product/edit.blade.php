@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Product')

@section('css')
    <!-- include summernote css-->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')
    <div>
        <a href="{{ route('product.index') }}" class="btn btn-dark">All Products</a>
    </div>
    <hr>
    <form action="{{ route('product.update', $product->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->any())
            @foreach ($errors->all() as $e)
                <div class="alert alert-danger">{{ $e }}</div>
            @endforeach
        @endif
        <div class="row">
            <div class="col-8">
                <div class="card p-3">
                    <small class="card-title text-bold">Product info</small>
                    <div class="form-group">
                        <label for="name">Enter product name</label>
                        <input type="text" value="{{ $product->name }}" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="image">Enter product image</label>
                        <input type="file" name="image" class="form-control" />
                        <img src="{{ asset('/images/' . $product->image) }}" class="img-thumbnail" style="width: 200px" />
                    </div>
                    <div class="form-group">
                        <label for="description">Enter product description</label>
                        <textarea type="text" id="description" name="description" class="form-control" rows='5'>{{ $product->description }}</textarea>
                    </div>

                </div>
                <hr>
                <div class="card p-3">
                    <small class="card-title text-dark text-bold">Product Prices</small>
                    <div class="form-group">
                        <label for="buy_price">Buying Price</label>
                        <input type="number" value="{{ $product->buying_price }}" name="buying_price"
                            class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" value="{{ $product->sale_price }}" name="sale_price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" value="{{ $product->discount_price }}" name="discount_price"
                            class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="total_quantity">Total quantity</label>
                        <input type="number" value="{{ $product->total_quantity }}" name="total_quantity"
                            class="form-control" disabled />
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-3">
                    <div class="form-group">
                        <label for="supplier">Choose Supplier</label>
                        <select name="supplier_id" class="form-control" disabled>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @if ($supplier->id == $product->supplier_id) selected @endif>
                                    {{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Choose Brand</label>
                        <select name="brand_slug" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}" @if ($product->brand_id == $brand->id) selected @endif>
                                    {{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Choose Category</label>
                        <select name="category_slug[]" class="form-control" id="category" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}"
                                    @foreach ($product->category as $productCateogry)
                                @if ($productCateogry->id == $category->id)
                                selected
                                @endif @endforeach>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Choose Color</label>
                        <select name="color_slug[]" class="form-control" id="color" multiple>
                            @foreach ($colors as $color)
                                <option value="{{ $color->slug }}"
                                    @foreach ($product->color as $productColor)
                                    @if ($productColor->id == $color->id)
                                    selected
                                    @endif @endforeach>
                                    {{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Update" class="btn btn-primary" />
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <!-- include summernote js-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#category').select2();
        $('#color').select2();
    </script>
@endsection
