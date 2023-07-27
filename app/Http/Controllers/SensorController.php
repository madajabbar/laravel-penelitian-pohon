<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
class SensorController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Sensor';
        if($request->ajax()){
            $value = Sensor::all();
            return DataTables::of($value)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm">View</a>';
                            return $btn;
                    })
                    ->addColumn('user', function($row){
                        return $row->node->user->name;
                    })
                    ->addColumn('id_node', function($row){
                        return $row->node->id_unique;
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.sensor.index',$data);
    }
}
