@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Product</h3>
        </div>
        <div>
            <a href="{{ route('product.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">

        <form id="form" action="{{ route('product.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- <input type="text" value="{{route('product.store')}}" name="url"> --}}
            <input type="hidden" value="{{ $product->id }}" name="productId">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
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
                        <select name="c_id" id="cat_id" class="form-control " style="background-color: #30333a">
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
                    <div class="form-group" >
                        <strong>Image:<sup class="text-danger">*</sup></strong>
                        <input type="file" name="photo" id="photo" class="form-control" style="background-color: #30333a" multiple>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="submitBtn" onclick="checkValidation()"
                        class="btn btn-outline-primary btn-md mt-2 mb-3">
                        <i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>






        </form>
    @endsection

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        // Trigger validation and form submit on button click
        function checkValidation() {
            toastr.clear();

            if ($('#name').val().trim() == '') {
                toastr.error('Please enter name...');
                return false;
            }
            if ($('#description').val().trim() == '') {
                toastr.error('Please enter description...');
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
            if ($('#photo').val().trim() == '') {
                toastr.error('Please choose photo...');
                return false;
            }


            saveData();
        }



    </script>
