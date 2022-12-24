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
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="image">Enter product image</label>
                        <input type="file" name="image" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="description">Enter product description</label>
                        <textarea type="text" id="description" name="description" rows="5" class="form-control"></textarea>
                    </div>

                </div>
                <hr>
                <div class="card p-3">
                    <small class="card-title text-dark text-bold">Product Prices</small>
                    <div class="form-group">
                        <label for="buy_price">Buying Price</label>
                        <input type="number" name="buying_price" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="discount_price">Discount Price</label>
                        <input type="number" name="discount_price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="total_quantity">Total quantity</label>
                        <input type="number" name="total_quantity" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card p-3">
                    <div class="form-group">
                        <label for="supplier">Choose Supplier</label>
                        <select name="supplier_id" class="form-control">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Choose Brand</label>
                        <select name="brand_slug" class="form-control">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Choose Category</label>
                        <select name="category_slug[]" class="form-control" id="category" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Choose Color</label>
                        <select name="color_slug[]" class="form-control" id="color" multiple>
                            @foreach ($colors as $color)
                                <option value="{{ $color->slug }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Create" class="btn btn-primary" />
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

        // $('#description').summernote({
        //     callbacks: {
        //         onImageUpload: function(files) {
        //             const formData = new FormData();
        //             formData.append('image', files[0]);
        //             formData.append('_token', "@php echo csrf_token(); @endphp")
        //             $.ajax({
        //                 method: 'POST',
        //                 url: '/admin/product/image-upload',
        //                 contentType: false,
        //                 processData: false,
        //                 data: formData,
        //                 success: function(data) {
        //                     $('#description').summernote('insertImage', data);
        //                 }
        //             })
        //         }
        //     }
        // });
    </script>
@endsection
