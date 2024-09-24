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
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
