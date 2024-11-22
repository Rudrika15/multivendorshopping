@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Attribute </h3>
        </div>
        <div>
            <a href="{{ route('attribute.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form id="attributeForm" action="{{ route('attribute.update') }}" method="post">

        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="attributeId" id="attributeId" value="{{ $attribute->id }}">

                <div class="form-group">
                    <strong> Name:</strong>
                    <input type="text" name="name" id="name" value="{{ $attribute->name }}" class="form-control"
                        placeholder="Enter value">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose a category:<sup class="text-danger">*</sup></strong>
                    <select name="catId" id="catId" class="form-control bg-dark">
                        <option disabled selected>select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <button type="button" class="btn btn-primary" id="updateBtn" value="{{ $attribute->id }}">Submit</button>
            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Intercept button click for form submission
            $('#updateBtn').on('click', function(e) {
                e.preventDefault(); // Prevent the form's default submission

                if (validateForm()) {
                    updateAttribute();
                }
            });

            // Function to update the attribute value via AJAX
            function updateAttribute() {
                var url = "{{ route('attribute.update') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: $('#attributeId').val(),
                        name: $('#name').val(),
                        catId: $('#catId').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Attribute updated successfully.');
                            $('#attributeForm')[0].reset(); // Reset the form
                        } else {
                            toastr.error(response.message || 'An error occurred while updating.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            }

            // Form validation function
            function validateForm() {
                let name = $('#name').val().trim();
                let catId = $('#catId').val();

                if (!name) {
                    toastr.error('Please enter Attribute name.');
                    return false;
                }

                if (!catId) {
                    toastr.error('Please choose an category.');
                    return false;
                }

                return true; // Form is valid
            }
        });
    </script>
@endsection
