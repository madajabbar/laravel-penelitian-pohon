<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Relay;
use App\Traits\CreateDataTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RelayController extends Controller
{
    use CreateDataTrait;
    public function index(Request $request){
        $data['title'] = 'Relay';
        $data['control'] = Control::all();
        if($request->ajax()){
            $value = Relay::all();
            return DataTables::of($value)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm">View</a>';
                            return $btn;
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at)->format('Y-m-d');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.relay.index',$data);
    }
    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'control_id' => 'required',
            ]
            );

        $data = $this->CreateOrUpdateRelay($request);
        return $data;
    }
    public function change(Request $request){
        $request->validate(
            [
                'id' => 'required',
            ]
        );
        $data = Relay::find($request->id);
        $data->status = $data->status == 'on' ? 'off':"on";
        $data->save();
        return $data->status;
    }
}
