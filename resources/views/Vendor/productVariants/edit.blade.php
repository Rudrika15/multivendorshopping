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


    <form id="productVariantForm" action="{{ route('productVariant.update') }}" method="post">
        @csrf
        {{-- @method('PATCH') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="productVariantId" value="{{ $productVariant->id }}" id="productVariantId">

                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="variantName" id="variantName" value="{{ $productVariant->variantName }}"
                        class="form-control" placeholder="Name">

                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose a Product:<sup class="text-danger">*</sup></strong>
                    <select name="proId" id="proId" class="form-control bg-dark">
                        <option disabled>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $product->id == $productVariant->productId ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
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
                    <strong>stock:</strong>
                    <input type="text" name="stock" id="stock" value="{{ $productVariant->stock }}"
                        class="form-control" placeholder="Price">
                    <div class="alert alert-danger mt-1 mb-1 d-none" id="price-error"></div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <button class="btn btn-primary" id="updateBtn" value="{{ $productVariant->id }}">Submit</button>

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
                    updateProductVariant();
                }
            });

            function updateProductVariant() {
                var url = "{{ route('productVariant.update') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: $('#productVariantId').val(),
                        variantName: $('#variantName').val(),
                        proId: $('#proId').val(),
                        price: $('#price').val(),
                        stock: $('#stock').val(),

                    },
                    success: function(response) {
                        if (response.success) {
                            $('#productVariantForm')[0].reload();
                        }
                        window.location.href = "{{ route('productVariant.index') }}";
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            }

            function validateForm() {
                let variantName = $('#variantName').val().trim();
                let proId = $('#proId').val();
                let price = $('#price').val().trim();
                let stock = $('#stock').val().trim();

                if (!variantName) {
                    toastr.error('Please enter product variant name.');
                    return false;
                }


                if (!proId) {
                    toastr.error('Please choose an product.');
                    return false;
                }
                if (!price) {
                    toastr.error('Please enter product variant price.');
                    return false;
                }
                if (!stock) {
                    toastr.error('Please enter product variant stock.');
                    return false;
                }


                return true;
            }
        });
    </script>
@endsection
