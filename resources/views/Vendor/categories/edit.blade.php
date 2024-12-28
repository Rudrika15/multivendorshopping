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
        <form id="categoryForm" action="{{ route('category.update') }}" method="post" enctype="multipart/form-data">
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
                        <input type="file" name="categoryIcon" id="categoryIcon" class="form-control"
                            style="background-color: #30333a" accept="image/*">
                    </div>
                </div>

                
                <div class="col-xs-12 col-sm-12 col-md-12 mt-3">

                    <img src="{{ asset('categories') }}/{{ $category->categoryIcon }}" style="width: 100px" alt="">
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" id="updateBtn" class="btn btn-outline-primary btn-md mt-2 mb-3">
                        <i class="fa-solid fa-floppy-disk"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#updateBtn').on('click', function(e) {
                e.preventDefault();

                if (validateForm()) {
                    updateCategory();
                }
            });

            function updateCategory() {
                var url = "{{ route('category.update') }}";
                var formData = new FormData($('#categoryForm')[0]);

                formData.append('_token', '{{ csrf_token() }}');
                formData.append('id', $('#categoryId').val());
                formData.append('categoryName', $('#categoryName').val());

                var photoInput = $('#categoryIcon')[0];
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
                            window.location.href = "{{ route('category.index') }}";

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
                let categoryName = $('#categoryName').val().trim();

                if (!categoryName) {
                    toastr.error('Please enter a category name.');
                    return false;
                }

                return true;
            }
        });
    </script>
@endsection
