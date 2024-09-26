@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<!-- Success and Error Messages -->
<div id="success-message" class="alert alert-success d-none">
    Product updated successfully.
</div>

<div id="error-message" class="alert alert-danger d-none">
    There was an error updating the product.
</div>

<form id="productForm">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                <div class="alert alert-danger mt-1 mb-1 d-none" id="name-error"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" id="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                <div class="alert alert-danger mt-1 mb-1 d-none" id="detail-error"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <button type="button" id="submitBtn" class="btn btn-outline-primary btn-md mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript">
    // Form Validation
    function validateForm() {
        $('#productForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                detail: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                name: {
                    required: "Please enter the product name",
                    minlength: "Product name must be at least 3 characters"
                },
                detail: {
                    required: "Please enter product details",
                    minlength: "Product detail must be at least 5 characters"
                }
            },
            errorPlacement: function (error, element) {
                toastr.error(error.text());
            },
            submitHandler: function (form) {
                // Call the saveData function on successful validation
                saveData();
                return false;
            }
        });
    }

    // Save Data using AJAX
    function saveData() {
        let formData = {
            '_token': $('input[name="_token"]').val(),
            '_method': 'PUT',
            'name': $('#name').val(),
            'detail': $('#detail').val()
        };

        $.ajax({
            type: "POST",
            url: "{{ route('products.update', $product->id) }}",
            data: formData,
            success: function (response) {
                if (response.success) {
                    toastr.success('Product updated successfully.');
                    $('#productForm')[0].reset(); // Clear the form
                }
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors.name) {
                    toastr.error(errors.name[0]);
                }
                if (errors.detail) {
                    toastr.error(errors.detail[0]);
                }
            }
        });
    }

    // Initialize validation and submit handler
    $(document).ready(function () {
        validateForm();

        // Trigger form submission
        $('#submitBtn').click(function () {
            $('#productForm').submit();
        });
    });

    // Toastr configuration (optional)
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "5000",
    };
</script>

@endsection
