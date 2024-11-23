@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Attribute Value</h3>
        </div>
        <div>
            <a href="{{ route('attributeValue.index') }}" class="btn btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <form id="attributeValueForm" action="{{ route('attributeValue.update') }}" method="post">

        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="attributeValueId" id="attributeValueId" value="{{ $attributeValue->id }}">

                <div class="form-group">
                    <strong> Name:</strong>
                    <input type="text" name="value" id="value" value="{{ $attributeValue->value }}"
                        class="form-control" placeholder="Enter value">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose an Attribute:<sup class="text-danger">*</sup></strong>
                    <select name="attrId" id="attrId" class="form-control bg-dark">
                        <option disabled selected>Select attribute</option>
                        @foreach ($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <button type="button" class="btn btn-primary" id="updateBtn"
                    value="{{ $attributeValue->id }}">Submit</button>
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
                    updateAttributeValue();
                }
            });

            function updateAttributeValue() {
                var url = "{{ route('attributeValue.update') }}";

                $.ajax({
                    url: url,
                    type: "POST",
                    cache: false,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: $('#attributeValueId').val(),
                        value: $('#value').val(),
                        attrId: $('#attrId').val(),
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Attribute Value updated successfully.');
                            $('#attributeValueForm')[0].reset();
                        } else {
                            toastr.error(response.message || 'An error occurred while updating.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                    }
                });
            }

            function validateForm() {
                let value = $('#value').val().trim();
                let attrId = $('#attrId').val();

                if (!value) {
                    toastr.error('Please enter Attribute Value.');
                    return false;
                }

                if (!attrId) {
                    toastr.error('Please choose an Attribute.');
                    return false;
                }

                return true;
            }
        });
    </script>
@endsection
