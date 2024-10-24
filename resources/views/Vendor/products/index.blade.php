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
            <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Product</a>
        </div>
    </div>

    @component('layouts.table', [
        'tableId' => 'productTable',
        'photoPath' => '',
        'ajaxUrl' => route('product.index'),
        'columns' => [
            ['title' => 'Id', 'data' => 'id'],
            ['title' => 'Product Name', 'data' => 'name'],
            ['title' => 'description', 'data' => 'description'],
            ['title' => 'Price', 'data' => 'price'],
            ['title' => 'slug', 'data' => 'slug '],
            ['title' => 'Category Name', 'data' => 'categoryId'],
        ],
    ])
    @endcomponent

    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();

            $(document).on('click', '.delete', function() {
                var id = $(this).data('id');
                if (confirm("Are you sure you want to delete this product?")) {
                    $.ajax({
                        url: "{{ route('product.destroy', ':id') }}".replace(':id',
                            id),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Product deleted successfully.');
                                $('#productTable').DataTable().ajax
                                    .reload();
                            } else {
                                toastr.error('Something went wrong.');
                            }
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON.errors;
                            if (errors) {
                                $.each(errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
