@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/assets/css/pages/datatables.css') }}">
<link rel="stylesheet" href="{{asset('dist/assets/extensions/choices.js/public/assets/styles/choices.css')}}">

@endsection


@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>DataTable for {{ $title }}</h3>
                <a href="{{url('api/admin/node')}}">test</a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="{{ route(strtolower($title) . '.index') }}">
                            <a href="index.html">{{ $title }}/</a>
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
                    {{ $title }} Datatable
                </div>
                <div class="button">
                    <button class="btn btn-primary rounded-pill input" data-bs-toggle="modal" data-bs-target="#backdrop">
                        Add New {{ $title }}
                    </button>
                </div>

                <!--Disabled Backdrop Modal -->
                @include('backend.node.form')
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Node</th>
                            <th>Name</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Sensor/Relay</th>
                            <th>Created Time</th>
                            <th>Action</th>
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
    <script src="{{ asset('dist/assets/js/pages/datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{asset('dist/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
    <script src="{{ asset('dist/assets/js/pages/form-element-select.js') }}"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('node.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id_unique',
                        name: 'id_unique'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'sensor/relay',
                        name: 'sensor/relay'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
    <script>
        $('body').on('click', '.input', function() {
            $('#name').val('');
        })

        $('body').on('click', '.edit', function() {
            var data_id = $(this).data('id');
            $.get("{{ route('node.index') }}" + '/' + data_id + '/edit', function(data) {
                $('#exampleModalCenterTitle').html("Edit anggota");
                $('#saveBtn').html("edit");
                $('#backdrop').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $("#user_id option").filter(function () {
                    console.log(data.user_id);
                    return $.trim($(this).val()) == data.user_id
                }).prop('selected', true);
                // $('.choices').selectpicker('refresh')
            })
        });
    </script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');
                var myform = document.getElementById('dataForm');
                var formData = new FormData(myform);
                $.ajax({
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "{{ route('node.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        $('#ajaxModel').modal('hide');
                        $('#saveBtn').html('success');
                        // $('#name').val('');
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil dimasukan',
                        })
                        reloadDatatable();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Error!',
                        })
                        $('#saveBtn').html('Error');
                    }
                });
            });
        });
    </script>
@endsection
