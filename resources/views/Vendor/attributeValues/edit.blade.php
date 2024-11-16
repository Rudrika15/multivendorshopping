@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Attribute Value</h3>
        </div>
        <div>
            <a href="{{ route('attributeValue.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
    </div>


    <form id="attributeValueForm" action="{{ route('attributeValue.update',$attributeValue->id) }}" method="post" >
         @csrf
        {{-- @method('PATCH') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="attributeValueId" value="{{ $attributeValue->id }}">

                <div class="form-group">
                    <strong> Name:</strong>
                    <input type="text" name="value" id="value" value="{{ $attributeValue->value }}"
                        class="form-control" placeholder="value">
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Choose a Attribute:<sup class="text-danger">*</sup></strong>
                    <select name="attrId" id="attrId" class="form-control bg-dark">
                        <option disabled selected>select attribute</option>
                        @foreach ($attributes as $attribute)
                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                        @endforeach

                    </select>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                <button class="btn btn-primary" id="updateBtn" value="{{ $attribute->id }}">Submit</button>

            </div>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script>
        $(document).ready(function(){

    $(document).on("click", "#updateBtn", function() {
        var url = "{{URL('attributeValue.update/'.$attributeValue->id)}}";
        var id=
		$.ajax({
			url: url,
			type: "POST",
			cache: false,
			data:{
                _token:'{{ csrf_token() }}',
				type: 3,
				name: $('#value').val(),
				city: $('#attrId').val()
			},
            success: function(response) {
                    if (response.success) {
                        toastr.success('Attribute Value updated successfully.');
                        $('#attributeValueForm')[0].reset(); // Clear the form
                    }
                },
		});
	});


});



    </script>
    @endsection
