@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Edit Attribute</h3>
        </div>
        <div>
            <a href="{{ route('attribute.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>
                Back</a>
        </div>
    </div>


    <form id="attributeForm" action="{{ route('attribute.update',$attribute->id) }}" method="post" >
         @csrf
        {{-- @method('PATCH') --}}

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="hidden" name="attributeId" value="{{ $attribute->id }}">

                <div class="form-group">
                    <strong> Name:</strong>
                    <input type="text" name="name" id="name" value="{{ $attribute->name }}"
                        class="form-control" placeholder="Name">
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
        var url = "{{URL('attribute.update/'.$attribute->id)}}";
        var id=
		$.ajax({
			url: url,
			type: "POST",
			cache: false,
			data:{
                _token:'{{ csrf_token() }}',
				type: 3,
				name: $('#name').val(),
				city: $('#catId').val()
			},
            success: function(response) {
                    if (response.success) {
                        toastr.success('Attribute updated successfully.');
                        $('#attributeForm')[0].reset(); // Clear the form
                    }
                },
		});
	});


});



    </script>
    @endsection
