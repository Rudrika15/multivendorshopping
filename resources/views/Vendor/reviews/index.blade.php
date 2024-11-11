@extends('layouts.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Review Management</h3>
        </div>
    </div>

    @component('layouts.table', [
        'tableId' => 'reviewTable',
        'photoPath' => '',
        'ajaxUrl' => route('review.index'),
        'columns' => [
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Review Text', 'data' => 'reviewText'],
            ['title' => 'User Id', 'data' => 'userId'],
            ['title' => 'Product Id', 'data' => 'productId'],
            ['title' => 'Rating', 'data' => 'rating'],
        ],
        'imageFields' => [''],
    ])
    @endcomponent
@endsection
