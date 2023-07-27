<?php

namespace App\Http\Controllers;

use App\Models\Relay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class RelayController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'Relay';
        if($request->ajax()){
            $value = Relay::all();
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
        return view('backend.relay.index',$data);
    }
}
