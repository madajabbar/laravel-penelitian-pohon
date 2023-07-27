@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/pages/datatables.css') }}">
@endsection


@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable for {{$title}}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="{{route(strtolower($title).'.index')}}">
                            <a href="index.html">{{$title}}/</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            DataTable Jquery
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="text">
                    {{$title}} Datatable
                </div>
                <div class="button">
                    <button class="btn btn-primary rounded-pill">
                        Add New Node
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Created Time</th>
                            <th>ID Sensor</th>
                            <th>ID Node</th>
                            <th>User</th>
                            <th>Soil Moisture</th>
                            <th>Humidity</th>
                            <th>Temperature</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
@endsection

@section('js')
    <script src="{{ asset('dist/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

    <script type="text/javascript">
        $(function () {

          var table = $('.table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('log.table') }}",
              columns: [
                  {data: 'created_at', name: 'created_at'},
                  {data: 'sensor', name: 'sensor.id_unique'},
                  {data: 'node', name: 'sensor.node.id_unique'},
                  {data: 'user', name: 'sensor.node.user.name'},
                  {data: 'soil_moisture', name: 'soil_moisture'},
                  {data: 'humidity', name: 'humidity'},
                  {data: 'temperature', name: 'temperature'},
              ]
          });
        });
      </script>
@endsection
