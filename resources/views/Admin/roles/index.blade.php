@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between">
    <div>
        <h3>Role Management</h3>
    </div>
    <div>
        <a href="{{ route('roles.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Role</a>
    </div>
</div>
<div class="bg-secondary rounded h-100 p-4 ">

<table class="table table-bordered">
  <tr>
     <th width="100px">No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
            @can('role-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
            @endcan

            @can('role-delete')
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->links('pagination::bootstrap-5') !!}


@endsection
