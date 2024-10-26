@extends('layouts.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Product Variant Management</h3>
        </div>
        <div>
            <a href="{{ route('productVariant.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Product
                Variant</a>
        </div>
    </div>

    @component('layouts.table', [
        'tableId' => 'productVariantTable',
        'photoPath' => '',
        'ajaxUrl' => route('productVariant.index'), 
        'columns' => [
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Variant Name', 'data' => 'variantName'],
            ['title' => 'Product Id', 'data' => 'productId'],
            ['title' => 'Price', 'data' => 'price'],
            ['title' => 'stock', 'data' => 'stock'],
        ],
        'imageFields' => [''],
    ])
    @endcomponent
@endsection
