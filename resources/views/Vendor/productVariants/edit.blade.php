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


    <form id="productVariantForm" action="{{ route('productVariant.update',$productVariant->id) }}" method="post" >
         @csrf
        {{-- @method('PATCH') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="productVariantId" value="{{ $productVariant->id }}">

                <div class="form-group">
                    <strong>Variant Name:</strong>
                    <input type="text" name="variantName" id="variantName" value="{{ $productVariant->variantName }}"
                        class="form-control" placeholder="Name">

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
                <button class="btn btn-primary" id="updateBtn" value="{{ $productVariant->id }}">Submit</button>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script>
    $(document).ready(function() {

        $(document).on("click", "#updateBtn", function() {
            if (checkValidation()) {
                updateProductVariant();
            }
        });

        function checkValidation() {
            toastr.clear();

            if ($('#variantName').val().trim() == '') {
                toastr.error('Please enter Variant Name...');
                return false;
            }
            if ($('#productId').val().trim() == '') {
                toastr.error('Please choose Product...');
                return false;
            }
            if ($('#price').val().trim() == '') {
                toastr.error('Please enter price...');
                return false;
            }
            if ($('#stock').val().trim() == '') {
                toastr.error('Please enter stock...');
                return false;
            }

            return true;
        }

        function updateProductVariant() {
            var url = "{{URL('productVariant.update/'.$productVariant->id)}}";

            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    type: 3,
                    name: $('#variantName').val(),
                    stock: $('#stock').val(),
                    price: $('#price').val(),
                    productId: $('#productId').val()
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Product Variant updated successfully.');
                        $('#productVariantForm')[0].reset(); // Clear the form
                    }
                },
            });
        }

    });
</script>
@endsection

