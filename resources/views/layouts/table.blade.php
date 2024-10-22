<table class="table table-bordered" id="{{ $tableId }}" style="background-color: #191C24 !important">
    <thead>
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column['title'] }}</th>
            @endforeach
            <th>Action</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#{{ $tableId }}').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ $ajaxUrl }}",
            columns: [
                @foreach ($columns as $column)
                    {
                        data: '{{ $column['data'] }}',
                        name: '{{ $column['data'] }}'
                    },
                @endforeach {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
