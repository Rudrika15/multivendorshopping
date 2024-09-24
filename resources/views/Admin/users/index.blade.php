@extends('Admin.layouts.app')
@section('title', 'User Management')
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>User Management</h3>
        </div>
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add User</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="badge bg-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}"><i
                                class="fa-solid fa-list"></i> Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"><i
                                class="fa-solid fa-pen-to-square"></i> Edit</a>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    

    {!! $data->links('pagination::bootstrap-5') !!}
@endsection
