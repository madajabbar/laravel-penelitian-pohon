<div class="row">
    @foreach ($relay as $data)
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{$data->name}}</h4>
                </div>
                <div class="card-body">
                    <div class="container text-center">
                        <button type="button" class="btn {{$data->status=='on'?'btn-success':'btn-danger'}}" id="button-{{$data->id}}" onclick="change({{$data->id}})">
                            <h3 class="text-white" id="status-{{$data->id}}">{{strtoupper($data->status)}}</h3>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
