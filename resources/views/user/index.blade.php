@extends('user.app')

@section('css')
@endsection

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                @include('user.utility.box-pot')
                @include('user.utility.radial-chart')
                @include('user.utility.box-control')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Log Data Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Latest Data</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg" id="log-table">
                                        <thead>
                                            <tr>
                                                <th>Node</th>
                                                <th>Sensor</th>
                                                <th>Humidity</th>
                                                <th>Soil Moisture</th>
                                                <th>Temperatuer</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('dist/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    @include('user.js.js-linechart')
    @include('user.js.js-radialgradient')
    @include('user.js.js-log-table')
@endsection
