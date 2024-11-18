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



    <form id="productForm" action="{{ route('product.update', $product->id) }}" method="post">
         @csrf
        {{-- @method('PATCH')  --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" value="{{ $product->id }}" name="productId">

                <div class="form-group">
                    <strong>Name :<sup class="text-danger">*</sup></strong>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                        value="{{ $product->name }}">
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
                            <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:<sup class="text-danger">*</sup></strong>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Price"
                        value="{{ $product->price }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button class="btn btn-primary" id="updateBtn" value="{{ $product->id }}"><i class="fa-solid fa-floppy-disk"></i>Submit</button>

            </div>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script type="text/javascript">
    $(document).ready(function() {

        $(document).on("click", "#updateBtn", function() {
            if (checkValidation()) {
                updateProduct();
            }
        });

        function checkValidation() {
            toastr.clear();

            if ($('#name').val().trim() == '') {
                toastr.error('Please enter Product Name...');
                return false;
            }
            if ($('#description').val().trim() == '') {
                toastr.error('Please enter product description...');
                return false;
            }
            if ($('#price').val().trim() == '') {
                toastr.error('Please enter price...');
                return false;
            }
            if ($('#cat_id').val().trim() == '') {
                toastr.error('Please choose category...');
                return false;
            }

            return true;
        }

        function updateProduct() {
            var url = "{{URL('product.update/'.$product->id)}}";

            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    type: 3,
                    name: $('#name').val(),
                    stock: $('#description').val(),
                    price: $('#price').val(),
                    productId: $('#cat_id').val()
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Product updated successfully.');
                        $('#productForm')[0].reset(); // Clear the form
                    }
                },
            });
        }

    });

    </script>
@endsection
