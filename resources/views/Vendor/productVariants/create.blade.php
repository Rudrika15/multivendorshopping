@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Create Product Variant</h3>
        </div>
        <div>
            <a href="{{ route('productVariant.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <form id="form"  method="post" action="{{ route('productVariant.store') }}">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Variant Name:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="variantName" id="variantName" class="form-control" placeholder="Enter Variant Name">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Choose a Product:<sup class="text-danger">*</sup></strong>
                        <select name="proId" id="productId" class="form-control bg-dark">
                            <option disabled selected>select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Price:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Stock:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="stock" id="stock" class="form-control" placeholder="Enter Stock">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="submitBtn" onclick="checkValidation()"
                        class="btn btn-outline-primary btn-md mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i>
                        Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
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

        saveData();
    }


</script>
