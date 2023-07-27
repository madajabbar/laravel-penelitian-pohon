<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\Node;
use App\Models\User;
use App\Traits\CreateDataTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class NodeController extends Controller
{
    use CreateDataTrait;
    public function index(Request $request){
        $data['title'] = 'Node';
        $data['user'] = User::all();
        if($request->ajax()){
            $value = Node::all();
            return DataTables::of($value)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="view btn btn-success btn-sm">View</a>
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm">Edit</a>
                            ';
                            return $btn;
                    })
                    ->addColumn('user', function($row){
                        return $row->user->name;
                    })
                    ->addColumn('sensor/relay', function($row){
                        return count($row->sensor)+count($row->relay);
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at);
                    })
                    ->addColumn('type', function($row){
                        $type = $row->id_unique;
                        if(str_contains($type,'NM')){
                            $type = 'NODE MONITOR';
                        }
                        else{
                            $type = 'NODE CONTROL';
                        }
                        return $type;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.node.index',$data);
    }

    public function store(Request $request){
        $request->validate(
            [
                'user_id' => 'required'
            ]
        );
        $data = $this->CreateOrUpdateNode($request);
        return ResponseFormatter::error();
        return $data;

    }

    public function edit($id){
        $data = Node::find($id);
        return $data;
    }
}
