@extends('layouts.app')
@section('title', 'User Management')
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3> Service Provider List</h3>
        </div>

    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </table>


    {!! $data->links('pagination::bootstrap-5') !!}
@endsection
