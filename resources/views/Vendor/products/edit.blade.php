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

    <!-- Success and Error Messages -->
    <div id="success-message" class="alert alert-success d-none">
        Product  updated successfully.
    </div>

    <div id="error-message" class="alert alert-danger d-none">
        There was an error updating the product .
    </div>

    <form id="productForm" onsubmit="validateForm()">
        {{-- @csrf
        @method('PUT') --}}

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <input type="hidden" value="{{ $product->id }}" name="productId">

                    <div class="form-group">
                        <strong>Name :<sup class="text-danger">*</sup></strong>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $product->name}}">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:<sup class="text-danger">*</sup></strong>
                        <textarea class="form-control" name="description" id="description" placeholder="Description" >{{ $product->description}}</textarea>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Choose a category:<sup class="text-danger">*</sup></strong>
                        <select name="cat_id" id="cat_id" class="form-control " style="background-color: #30333a">
                            <option disabled selected>select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="{{ $product->price}}">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="submitBtn"
                        class="btn btn-outline-primary btn-md mt-2 mb-3">
                        <i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>

        </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", "#submitBtn", function(e) {
                e.preventDefault();

                $('#productForm').validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        description: {
                            required: true,
                            minlength: 3
                        },
                        cat_Id: {
                            required: true
                        },
                        price: {
                            required: true,
                            minlength: 3
                        }

                    },
                    messages: {
                        name: {
                            required: "Please enter the product  name",
                            minlength: "Product name must be at least 3 characters"
                        },
                        description: {
                            required: "Please enter product description",
                            minlength: "description  must be at least 3 characters"
                        },
                        cat_Id: {
                            required: "Please choose a category"
                        },
                        price: {
                            required: "Please enter product price",
                            minlength: "Price must be at least 3 digits"
                        }

                    },
                    errorPlacement: function(error, element) {
                        toastr.error(error.text());
                    },
                    submitHandler: function(form) {
                        alert('Form is valid!'); // For testing
                        return false;
                    }
                });
            });
        });


        // // Save Data using AJAX
        // function saveData() {
        //     let formData = {
        //         '_token': $('input[name="_token"]').val(),
        //         '_method': 'PUT',
        //         'name': $('#name').val(),
       //         'description': $('#description').val(),
        //         'cat_Id': $('#cat_Id').val()
        //         'price': $('#price').val(),
        //     };
        //     $.ajax({

        //         type: "POST",
        //         url: "{{ route('product.update', $product->id) }}",
        //         data: formData,
        //         success: function(response) {
        //             if (response.success) {
        //                 toastr.success('Product  updated successfully.');
        //                 $('#productForm')[0].reset(); // Clear the form
        //             }
        //         },
        //         error: function(xhr) {
        //             let errors = xhr.responseJSON.errors;
        //             if (errors.name) {
        //                 toastr.error(errors.name[0]);
        //             }
        //             if (errors.description) {
        //                 toastr.error(errors.description[0]);
        //             }
        //             if (errors.cat_Id) {
        //                 toastr.error(errors.cat_Id[0]);
        //             }
        //             if (errors.price) {
        //                 toastr.error(errors.price[0]);
        //             }
        //         }
        //     });
        // }

        // // Initialize validation and submit handler
        // $(document).ready(function() {
        //     validateForm();

        //     console.log('submit');

        //     // Trigger form submission
        //     $('#submitBtn').click(function() {
        //         $('#productForm').submit();
        //     });
        // });

        // // Toastr configuration (optional)
        // toastr.options = {
        //     "closeButton": true,
        //     "progressBar": true,
        //     "positionClass": "toast-top-right",
        //     "timeOut": "5000",
        // };
    </script>
@endsection

