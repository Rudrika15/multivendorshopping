@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Category</h3>
        </div>
        <div>
            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <form id="categoryForm" action="{{ route('category.update') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $category->id }}" name="categoryId" id="categoryId">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="categoryName" id="categoryName" class="form-control"
                            placeholder="enter Category Name" value="{{ $category->categoryName }}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Image:<sup class="text-danger">*</sup></strong>
                        <input type="file" name="photo" id="photo" class="form-control"
                            style="background-color: #30333a">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-check">
                        <label>
                            <input class="form-check-input" name="parentId" type="checkbox" id="flexCheckDefault"
                                onclick="checkbox()">
                            Is Parent
                        </label>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12" id="dropdownDiv" style="display: none;">
                    <div class="form-group">
                        <select name="parentCategory" id="cat_id" class="form-control" style="background-color: #30333a">
                            <option disabled selected>select category</option>

                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">

                    <img src="{{ asset('categories') }}/{{ $category->categoryIcon }}" style="width: 100px" alt="">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="updateBtn" class="btn btn-outline-primary btn-md mt-2 mb-3">
                        <i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
    function checkbox() {
        document.getElementById('flexCheckDefault');
        const dropdownDiv = document.getElementById('dropdownDiv');
        if (flexCheckDefault.checked) {
            dropdownDiv.style.display = 'block';
        } else {
            dropdownDiv.style.display = 'none';
        }
    }

    $(document).ready(function() {

        $(document).on("click", "#updateBtn", function() {
            if (checkValidation()) {
                updateCategory();
            }
        });

        function checkValidation() {
            toastr.clear();

            if ($('#categoryName').val().trim() == '') {
                toastr.error('Please enter category Name...');
                return false;
            }

            return true;
        }

        function updateCategory() {
            var url = "{{ route('category.update') }}";

            $.ajax({
                url: url,
                type: "POST",
                cache: false,
                data: {
                    _token: '{{ csrf_token() }}',
                    type: 3,
                    id: $('#categoryId').val(),
                    name: $('#categoryName').val(),
                    photo: $('#photo').val()
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Category updated successfully.');
                        $('#categoryForm')[0].reset();
                    }
                },
            });
        }

    });
</script>
