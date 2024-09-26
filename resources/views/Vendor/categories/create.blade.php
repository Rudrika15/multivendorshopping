@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Create Category</h3>
        </div>
        <div>
            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <form id="form" action="{{ route('category.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Detail:</strong>
                        <textarea class="form-control" style="height:150px" name="detail" id="detail" placeholder="Detail"></textarea>
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
        if ($('#detail').val().trim() == '') {
            toastr.error('Please enter detail...');
            return false;
        }

        saveData();
    }
</script>
