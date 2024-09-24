@extends('Admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Create Role</h3>
        </div>
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
    </div>

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" placeholder="Name" class="form-control">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br />
                        <div class="row">

                            @foreach ($permission as $value)
                            <div class="col-md-4">
                                <label><input type="checkbox" name="permission[{{ $value->id }}]"
                                        value="{{ $value->id }}" class="name">
                                    {{ $value->name }}</label>
                                <br />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i>
                        Submit</button>
                </div>
            </div>
        </form>
    
@endsection
