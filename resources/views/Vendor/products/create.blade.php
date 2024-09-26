@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<form id="form" action="{{ route('product.store') }}" method="post">
    @csrf
    {{-- <input type="text" value="{{route('product.store')}}" name="url"> --}}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                <span class="text-danger" id="nameError"></span> <!-- Error message for name -->
            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <textarea class="form-control" style="height:150px" name="detail" id="detail" placeholder="Detail"></textarea>
                <span class="text-danger" id="detailError"></span> <!-- Error message for detail -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" id="submitBtn" class="btn btn-outline-primary btn-md mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>
@endsection
