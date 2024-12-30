@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Product </h3>
        </div>
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
    </div>


    <form id="productForm" action="{{ route('product.update') }}" method="post">
        @csrf
        {{-- @method('PATCH') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="productId" value="{{ $product->id }}" id="productId">

                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control"
                        placeholder="Name">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:<sup class="text-danger">*</sup></strong>
                    <textarea class="form-control" name="description" id="description" placeholder="Description">{{ $product->description }}</textarea>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose a category:<sup class="text-danger">*</sup></strong>
                    <select name="cat_id" id="cat_id" class="form-control " style="background-color: #30333a">
                        <option disabled selected>select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $product->categoryId ? 'selected' : '' }}>
                                {{ $category->categoryName }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>price:</strong>
                    <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control"
                        placeholder="Price">
                    <div class="alert alert-danger mt-1 mb-1 d-none" id="price-error"></div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button class="btn btn-primary" id="updateBtn" value="{{ $product->id }}">Submit</button>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script>
        $(document).ready(function() {
            $('#updateBtn').on('click', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    updateProduct();
                }
            });

            function updateProduct() {
                var url = "{{ route('product.update') }}";
                var formData = new FormData($('#productForm')[0]);

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('id', $('#productId').val());
                formData.append('name', $('#name').val());
                formData.append('description', $('#description').val());
                formData.append('price', $('#price').val());
                formData.append('cat_id', $('#cat_id').val());


                var photoInput = $('#photo')[0];
                if (photoInput.files && photoInput.files[0]) {
                    console.log('File selected:', photoInput.files[0]);
                    formData.append('categoryIcon', photoInput.files[0]);
                } else {
                    console.log('No file selected');
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "{{ route('product.index') }}";

                        } else {
                            toastr.error(response.message || 'An error occurred. Please try again.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            }

            function validateForm() {
                let name = $('#name').val().trim();
                let description = $('#description').val().trim();
                let price = $('#price').val().trim();

                if (!name) {
                    toastr.error('Please enter a product name.');
                    return false;
                }
                if (!description) {
                    toastr.error('Please enter a product deescription.');
                    return false;
                }
                if (!price) {
                    toastr.error('Please enter a product price.');
                    return false;
                }
                

                return true;
            }
        });
    </script>
@endsection

