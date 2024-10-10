@extends('layouts.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Product Management</h3>
        </div>
        <div>
            <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                Product</a>
        </div>
    </div>

    @component('layouts.table', [
        'tableId' => 'productTable',
        'ajaxUrl' => route('product.index'),
        'columns' => [
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Product Name', 'data' => 'name'],
            ['title' => 'Detail', 'data' => 'detail'],
        ],
    ])
    @endcomponent
@endsection
