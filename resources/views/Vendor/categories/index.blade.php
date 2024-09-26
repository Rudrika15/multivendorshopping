@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Category Management</h3>
        </div>
        <div>
            <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                Category</a>
        </div>
    </div>
    <div class="bg-secondary rounded h-100 p-4 ">

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($categories as $category)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $category->categoryName }}</td>
                    <td>{{ $category->categoryIcon }}</td>

                </tr>
            @endforeach
        </table>
    </div>
    {!! $categories->links() !!}
@endsection
