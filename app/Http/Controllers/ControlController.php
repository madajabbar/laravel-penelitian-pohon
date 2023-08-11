<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Traits\CreateDataTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ControlController extends Controller
{
    use CreateDataTrait;
    public function index(Request $request){
        $data['title'] = 'Control';
        if($request->ajax()){
            $value = Control::all();
            return DataTables::of($value)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="view btn btn-success btn-sm">View</a>
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm">Edit</a>
                            ';
                            return $btn;
                    })
                    ->addColumn('node', function($row){
                        return count($row->node);
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at)->format('Y-m-d');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.control.index',$data);
    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required',
            ]
        );
        $data = $this->CreateOrUpdateControl($request);
        return $data;

    }

    public function edit($id){
        $data = Control::find($id);
        return $data;
    }
}
