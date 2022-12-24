@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Product Image')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ url()->previous() }}"><button class="btn btn-dark">Back</button></a>
            <hr>
            <form action="{{ url('/admin/edit-product_images/' . $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <b>
                        Product Name:
                    </b>
                    <h6 class="d-inline ms-3">{{ $product->name }}</h6>
                </div>
                <div class="form-group mt-3">
                    <label for="images">Select images for current product</label>
                    <label for="images">( Please choose only 3 images )</label>
                    <input type="file" name="files[]" id="files" class="form-control w-30" multiple max="3" />
                </div>
                <div id="preview-area">
                    @foreach ($product->images as $image)
                        <div class="border d-inline-block me-2 image-preview">
                            <img src="{{ $image->image_url }}" class=" m-3" width="250px" height="210px">
                        </div>
                    @endforeach
                </div>
                <input type="submit" value='Update' class='btn btn-primary float-end mt-3'>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // to show user selected images in preview-area
        $('#files').change(function() {
            if ($('.image-preview').length) {
                $('.image-preview').remove();
            }
            // Get the list of selected files
            let files = $(this).prop('files');
            if (files.length !== 3) {
                if ($('#alert').length) {
                    $('#alert').hasClass('d-none') && $('#alert').removeClass('d-none');
                    return;
                }
                $('#preview-area').append(`
                    <div class='alert alert-danger d-flex align-items-center' id='alert'>
                        <div style='color: black'><i class='fa-solid fa-triangle-exclamation me-2'></i>You have to choose 3 images</div>
                    </div>
                `);
                return;
            }

            if ($('#alert').length) {
                $('#alert').addClass('d-none');
            }

            // Loop through the list of files
            $.each(files, function(i, file) {
                // Create a URL for the file
                let url = URL.createObjectURL(file);

                // Create an <img> element for the file
                let div = document.createElement('div');
                div.classList.add('border', 'd-inline-block', 'me-2', 'image-preview');

                let img = document.createElement('img');
                img.src = url;
                img.classList.add('m-2');
                img.style.width = '250px';
                img.style.hieght = '210px';
                div.append(img);
                // Add the <img> element to the preview area
                $('#preview-area').append(div);
            });
        });
    </script>
@endsection
