<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index(Request $request){
        $data['title'] = 'User';
        $data['user'] = User::all();
        if($request->ajax()){
            $value = User::all();
            return DataTables::of($value)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="view btn btn-success btn-sm">View</a>
                            <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-warning btn-sm">Edit</a>
                            ';
                            return $btn;
                    })
                    ->editColumn('created_at', function($row){
                        return Carbon::parse($row->created_at)->format('Y-m-d');
                    })
                    ->addColumn('pot', function($row){
                        $data = [];
                        foreach($row->node as $node){
                            foreach($node->sensor as $sensor){
                                $data[] = $sensor->name;
                            }
                        }
                        $hasil = count($data). " Buah";
                        return $hasil;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.user.index',$data);
    }

    public function store(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]
        );

        $data = User::updateOrCreate(
            [
                'id' => $request->id,
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => 'false'
            ]
        );
        return $data;
    }
    public function edit($id){
        $data = User::find($id);
        return $data;
    }
}
