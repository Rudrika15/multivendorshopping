@extends('layouts.app')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h3>Order List</h3>
        </div>
    </div>

    @component('layouts.table', [
        'tableId' => 'orderMasterTable',
        'photoPath' => '',
        'ajaxUrl' => route('order.index'),
        'columns' => [
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'User Id', 'data' => 'userId'],
            ['title' => 'Order Status', 'data' => 'orderStatus'],
            ['title' => 'Shipping Address', 'data' => 'shippingAddress'],
            ['title' => 'Payment Method', 'data' => 'paymentMethod'],
            ['title' => 'Total Amount', 'data' => 'totalAmount'],


        ],
        'imageFields' => [''],
    ])
    @endcomponent
@endsection
