<script>
    var options = {
        series: [{
                name: 'Soil Moisture',
                data: [
                    @foreach ($log as $data)
                        {{$data->soil_moisture}},
                    @endforeach
                ]
            },
            {
                name: 'Humidity',
                data: [

                @foreach ($log as $data)
                        {{$data->humidity}},
                    @endforeach
                ]
            },
            {
                name: 'Temperature',
                data: [

                @foreach ($log as $data)
                        {{$data->temperature}},
                    @endforeach
                ]
            }
        ],
        chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'datetime',
            categories: [
                @foreach ($log as $data)
                    "{{Carbon\Carbon::parse($data->time)->format('Y-m-d\TH:i:s\Z')}}",
                @endforeach
            ]
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
