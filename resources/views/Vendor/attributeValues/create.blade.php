@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Create Attribute Value</h3>
        </div>
        <div>
             <a href="{{ route('attributeValue.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <form id="form"  method="post"  action="{{ route('attributeValue.store') }}">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Value:<sup class="text-danger">*</sup></strong>
                        <input type="text" name="value" id="value" class="form-control" placeholder="Enter Value">
                    </div>
                </div>


                 <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Choose a Attribute:<sup class="text-danger">*</sup></strong>
                        <select name="attrId" id="attributeId" class="form-control bg-dark">
                            <option disabled selected>select attribute</option>
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach

                        </select>
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

        if ($('#value').val().trim() == '') {
            toastr.error('Please enter Value...');
            return false;
        }
        if ($('#attributeId').val().trim() == '') {
                toastr.error('Please choose Attribute...');
                return false;
            }


        saveData();
    }


</script>
