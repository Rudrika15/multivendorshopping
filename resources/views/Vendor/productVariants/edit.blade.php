@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Product Variant</h3>
        </div>
        <div>
            <a href="{{ route('productVariant.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
    </div>

    <!-- Success and Error Messages -->
    <div id="success-message" class="alert alert-success d-none">
        Product Variant updated successfully.
    </div>

    <div id="error-message" class="alert alert-danger d-none">
        There was an error updating the product Variant.
    </div>

    <form id="productVariantForm" onsubmit="validateForm()">
        {{-- @csrf
        @method('PUT') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="productVariantId" value="{{ $productVariant->id }}">

                <div class="form-group">
                    <strong>Variant Name:</strong>
                    <input type="text" name="variantName" id="variantName" value="{{ $productVariant->variantName }}"
                        class="form-control" placeholder="Name">
                    <div class="alert alert-danger mt-1 mb-1 d-none" id="name-error"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose a Product:<sup class="text-danger">*</sup></strong>
                    <select name="proId" id="proId" class="form-control bg-dark">
                        <option disabled selected>select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>price:</strong>
                    <input type="text" name="price" id="price" value="{{ $productVariant->price }}"
                        class="form-control" placeholder="Price">
                    <div class="alert alert-danger mt-1 mb-1 d-none" id="price-error"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Stock:</strong>
                    <input type="text" name="stock" id="stock" value="{{ $productVariant->stock }}"
                        class="form-control" placeholder="stock">
                    <div class="alert alert-danger mt-1 mb-1 d-none" id="stock-error"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button id="submitBtn" class="btn btn-outline-primary btn-md mt-2 mb-3"><i
                        class="fa-solid fa-floppy-disk"></i> Submit</button>
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

                $('#productVariantForm').validate({
                    rules: {
                        VariantName: {
                            required: true,
                            minlength: 3
                        },
                        price: {
                            required: true,
                            minlength: 3
                        },
                        stock: {
                            required: true,
                            minlength: 1
                        },
                        proId: {
                            required: true
                        }
                    },
                    messages: {
                        VariantName: {
                            required: "Please enter the product variant name",
                            minlength: "Product name must be at least 3 characters"
                        },
                        price: {
                            required: "Please enter price",
                            minlength: "Price must be at least 3 digits"
                        },
                        stock: {
                            required: "Please enter product stock",
                            minlength: "Stock must be at least 1 digit"
                        },
                        proId: {
                            required: "Please choose a product"
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
        //         'variantName': $('#variantName').val(),
        //         'price': $('#price').val(),
        //         'stock': $('#stock').val(),
        //         'proId': $('#proId').val()
        //     };
        //     console.log('hello');
        //     $.ajax({

        //         type: "POST",
        //         url: "{{ route('productVariant.update', $productVariant->id) }}",
        //         data: formData,
        //         success: function(response) {
        //             if (response.success) {
        //                 toastr.success('Product variant updated successfully.');
        //                 $('#productVariantForm')[0].reset(); // Clear the form
        //             }
        //         },
        //         error: function(xhr) {
        //             let errors = xhr.responseJSON.errors;
        //             if (errors.variantName) {
        //                 toastr.error(errors.variantName[0]);
        //             }
        //             if (errors.price) {
        //                 toastr.error(errors.price[0]);
        //             }
        //             if (errors.stock) {
        //                 toastr.error(errors.stock[0]);
        //             }
        //             if (errors.proId) {
        //                 toastr.error(errors.proId[0]);
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
        //         $('#productVariantForm').submit();
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
