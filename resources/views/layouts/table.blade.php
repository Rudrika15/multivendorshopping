<table class="table table-bordered" id="{{ $tableId }}" style="background-color: #191C24 !important">
    <thead>
        <tr style="max-width: 250px">
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
        let photoPath = "{{ asset($photoPath) }}"; // Getting the photo path dynamically
        let imageFields = {!! json_encode($imageFields) !!};

        $('#{{ $tableId }}').DataTable({
            processing: false,
            serverSide: true,
            ajax: "{{ $ajaxUrl }}",
            columns: [
                @foreach ($columns as $column)
                    @if (in_array($column['data'], $imageFields))
                        {
                            data: '{{ $column['data'] }}',
                            name: '{{ $column['data'] }}',
                            orderable: false,
                            searchable: false,
                            render: function(data) {
                                return `<img src="${photoPath}/${data}" width="50" height="50" alt="category     Image">`;
                            }
                        },
                    @else
                        {
                            data: '{{ $column['data'] }}',
                            name: '{{ $column['data'] }}',
                            orderable: {{ $column['orderable'] ?? 'false' }},
                            searchable: {{ $column['searchable'] ?? 'true' }}
                        },
                    @endif
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
