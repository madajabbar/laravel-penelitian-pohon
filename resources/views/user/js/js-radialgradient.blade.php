<script>
    var soilOption = {
        series: [{
            name: 'Soil Data',
            data: [],
        }],
        chart: {
            height: 350,
            type: "radialBar",
            toolbar: {
                show: true,
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#fff",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24,
                    },
                },
                track: {
                    background: "#fff",
                    strokeWidth: "67%",
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35,
                    },
                },

                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: "#888",
                        fontSize: "17px",
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: "#111",
                        fontSize: "36px",
                        show: true,
                    },
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: ["#ABE5A1"],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100],
            },
        },
        stroke: {
            lineCap: "round",
        },
        labels: ["Soil Moisture %"],
    };
    var soilRadialBarOptions = {
        series: [44, 55, 67, 83],
        chart: {
            height: 350,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: "22px",
                    },
                    value: {
                        fontSize: "16px",
                    },
                    total: {
                        show: true,
                        label: "Total",
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return 249;
                        },
                    },
                },
            },
        },
        labels: ["Apples", "Oranges", "Bananas", "Berries"],
    };
    var soilRadialGradient = new ApexCharts(
        document.querySelector("#soilmoistures"),
        soilOption
    );
    soilRadialGradient.render();

    function fetchDataAndUpdateChart() {
        // Replace with your actual AJAX call to fetch data from Laravel backend
        $.ajax({
            url: "{{ url('soil/' . $sensor->id) }}",
            method: 'GET',
            success: function(data) {
                var soilPoint = data.value;
                soilRadialGradient.updateSeries([soilPoint]);
                setTimeout(fetchDataAndUpdateChart, 1000); // Fetch data every 1 second
            }
        });
    }
    fetchDataAndUpdateChart(); // Start fetching and updating data
</script>
<script>
    var humidityRadialGradientOptions = {
        series: [],
        chart: {
            height: 350,
            type: "radialBar",
            toolbar: {
                show: true,
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#fff",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24,
                    },
                },
                track: {
                    background: "#fff",
                    strokeWidth: "67%",
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35,
                    },
                },

                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: "#888",
                        fontSize: "17px",
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: "#111",
                        fontSize: "36px",
                        show: true,
                    },
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: ["#ABE5A1"],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100],
            },
        },
        stroke: {
            lineCap: "round",
        },
        labels: ["Humidity %"],
    };
    var radialBarOptions = {
        series: [44, 55, 67, 83],
        chart: {
            height: 350,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: "22px",
                    },
                    value: {
                        fontSize: "16px",
                    },
                    total: {
                        show: true,
                        label: "Total",
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return 249;
                        },
                    },
                },
            },
        },
        labels: ["Apples", "Oranges", "Bananas", "Berries"],
    };
    var humidityRadialGradient = new ApexCharts(
        document.querySelector("#humidity"),
        humidityRadialGradientOptions
    );
    humidityRadialGradient.render();

    function updateHumi() {
        $.ajax({
            url: "{{ url('humitemp/' . $sensor->node->control->id) }}",
            method: 'GET',
            success: function(data) {
                var newDataPoint = data.humidity;
                humidityRadialGradient.updateSeries([newDataPoint]);
                setTimeout(updateHumi, 1000); // Fetch data every 1 second
            }
        });
    }

    // Initial update on page load
    updateHumi();
</script>
<script>
    var tempRadialGradientOptions = {
        series: [],
        chart: {
            height: 350,
            type: "radialBar",
            toolbar: {
                show: true,
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 225,
                hollow: {
                    margin: 0,
                    size: "70%",
                    background: "#fff",
                    image: undefined,
                    imageOffsetX: 0,
                    imageOffsetY: 0,
                    position: "front",
                    dropShadow: {
                        enabled: true,
                        top: 3,
                        left: 0,
                        blur: 4,
                        opacity: 0.24,
                    },
                },
                track: {
                    background: "#fff",
                    strokeWidth: "67%",
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35,
                    },
                },

                dataLabels: {
                    show: true,
                    name: {
                        offsetY: -10,
                        show: true,
                        color: "#888",
                        fontSize: "17px",
                    },
                    value: {
                        formatter: function(val) {
                            return parseInt(val);
                        },
                        color: "#111",
                        fontSize: "36px",
                        show: true,
                    },
                },
            },
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.5,
                gradientToColors: ["#ABE5A1"],
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100],
            },
        },
        stroke: {
            lineCap: "round",
        },
        labels: ["Temperature "],
    };
    var radialBarOptions = {
        series: [44, 55, 67, 83],
        chart: {
            height: 350,
            type: "radialBar",
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: "22px",
                    },
                    value: {
                        fontSize: "16px",
                    },
                    total: {
                        show: true,
                        label: "Total",
                        formatter: function(w) {
                            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                            return 249;
                        },
                    },
                },
            },
        },
        labels: ["Apples", "Oranges", "Bananas", "Berries"],
    };
    var tempRadialGradient = new ApexCharts(
        document.querySelector("#temperature"),
        tempRadialGradientOptions
    );
    tempRadialGradient.render();

    function updateTemp() {
        $.ajax({
            url: "{{ url('humitemp/' . $sensor->node->control->id) }}",
            method: 'GET',
            success: function(data) {
                var newDataPoint = data.temperature;
                tempRadialGradient.updateSeries([newDataPoint]);
                setTimeout(updateTemp, 1000); // Fetch data every 1 second
            }
        });
    }

    updateTemp();
</script>
