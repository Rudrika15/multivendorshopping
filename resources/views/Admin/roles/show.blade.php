@extends('Admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Show User</h3>
        </div>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i>Back</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 m-4 ">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if (!empty($rolePermissions))
                        @foreach ($rolePermissions as $v)
                            <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endsection
