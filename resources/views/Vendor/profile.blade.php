@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Update Store Profile</h3>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <form id="form" action="{{ route('update.profile') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Store Name:</strong>
                        <input type="text" name="storeName" id="name" class="form-control" placeholder="Enter Your Store Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Contact Number:</strong>
                        <input type="text" name="contactNo" id="contactNo" class="form-control"
                            placeholder="Enter Your Contact Number">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Logo:</strong>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address:</strong>
                        <textarea class="form-control" name="address" id="adress" placeholder="Enter Your Address "></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>City:</strong>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Enter Your City">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pincode:</strong>
                        <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter Your Pincode">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Landmark:</strong>
                        <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Enter Your Landmark">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>AadharCard Number:</strong>
                        <input type="text" name="aadharCardNo" id="aadharCardNo" class="form-control" placeholder="Enter Your AadharCard Number">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>PanCard Number:</strong>
                        <input type="text" name="panCardNo" id="panCardNo" class="form-control" placeholder="Enter Your PanCard Number">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> Store Description:</strong>
                        <textarea class="form-control" name="storeDescription" id="storeDescription" placeholder=" Enter Store Description"></textarea>

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

        if ($('#name').val().trim() == '') {
            toastr.error('Please enter name...');
            return false;
        }
        if ($('#contactNo').val().trim() == '') {
            toastr.error('Please enter Contact number...');
            return false;
        }
        if ($('#logo').val().trim() == '') {
            toastr.error('Please choose file...');
            return false;
        }
        if ($('#address').val().trim() == '') {
            toastr.error('Please enter Address...');
            return false;
        }
        if ($('#city').val().trim() == '') {
            toastr.error('Please enter City...');
            return false;
        }
        if ($('#pincode').val().trim() == '') {
            toastr.error('Please enter Pincode...');
            return false;
        }
        if ($('#landmark').val().trim() == '') {
            toastr.error('Please enter Landmark...');
            return false;
        }
        if ($('#aadharCardNo').val().trim() == '') {
            toastr.error('Please enter AadharCard Number...');
            return false;
        }
        if ($('#panCardNo').val().trim() == '') {
            toastr.error('Please enter panCard Number...');
            return false;
        } if ($('#storeDescription').val().trim() == '') {
            toastr.error('Please enter Store Description...');
            return false;
        }

        saveData();
    }
</script>
