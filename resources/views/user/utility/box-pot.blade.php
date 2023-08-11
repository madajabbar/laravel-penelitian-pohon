<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-3 col-sm-12 col-md-6">
                <button type="button" class="btn block w-100 h-100" style="background-color:purple;color:whitesmoke"
                    data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    Pilih Pot
                </button>
            </div>
            <div class="col-lg-9 col-sm-12 col-md-6">
                <div class="row">
                    <div class="col-lg-2 col-md-6 col-sm-6 justify-content-center mx-auto text-center">
                        <img src="{{ asset('anggur.png') }}" alt="" class="img-fluid w-50">
                    </div>
                    <div class="col-lg-10 col-md-6 col-sm-6 text-center justify-content-center">
                        <h2 class="my-3">{{ $title }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- button trigger for  Vertically Centered modal -->
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Pilih Pot Anda
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @php
                            $key = 0;
                        @endphp
                        @foreach ($node as $data)
                            @foreach ($data->sensor as $dataSensor)
                                <div class="col-lg-3 col-md-6 col-sm-6 my-2 mx-auto">
                                    <form action="{{route('home')}}" method="get">
                                        <input type="hidden" name="id_unique" value="{{$dataSensor->id_unique}}">
                                        <button type="submit" class="btn w-100 h-100 text-bold fs-1"
                                            style="background-color: purple;color:aliceblue">{{ ++$key }}
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
