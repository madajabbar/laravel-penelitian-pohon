<script>
    function updateTable() {
        $.ajax({
            url: "{{ url('home/log') }}",
            method: 'GET',
            success: function(data) {
                // Clear existing table rows
                $('#log-table tbody').empty();

                // Add new rows with updated values
                data.forEach(function(value) {
                    $('#log-table tbody').append(
                        '<tr>' +
                        '<td>' + value.sensor.node.id_unique + '</td>' +
                        '<td>' + value.sensor.id_unique + '</td>' +
                        '<td>' + value.humidity + '</td>' +
                        '<td>' + value.soil_moisture + '</td>' +
                        '<td>' + value.temperature + '</td>' +
                        '<td>' + value.created_at + '</td>' +
                        '</tr>'
                    );
                });
            },
            error: function() {
                // Handle errors if necessary
            }
        });
    }

    // Initial update on page load
    updateTable();

    // Set up periodic updates every 3 minutes
    setInterval(updateTable, 10 * 60 * 10); // 3 minutes in milliseconds
</script>
<script>
    function change(id) {
        $.post("{{ route('relay.change') }}", {
            id: id
        }, function(result) {
            let removeClass = '';
            let addClass = '';
            switch(result) {
                case 'on':
                    removeClass = 'btn-danger';
                    addClass = 'btn-success';
                    break;

                default:
                    removeClass = 'btn-success';
                    addClass = 'btn-danger';
                    break;
            }
            $("#button-"+id).removeClass(removeClass);
            $("#button-"+id).addClass(addClass);
            $("#status-"+id).html(result.toUpperCase());
        });
    }
</script>
