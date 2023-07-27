<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use DataTables;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Log';
        return view('backend.log.index', $data);
    }

    public function table()
    {
        $value = Log::query()->with(['sensor','sensor.node','sensor.node.user']);
        // return $value;
        return DataTables::of($value)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-warning btn-sm">View</a>';
                return $btn;
            })
            ->addColumn('user', function ($row) {
                return $row->sensor->node->user->name;
            })
            ->addColumn('sensor', function ($row) {
                return $row->sensor->id_unique;
            })
            ->addColumn('node', function ($row) {
                return $row->sensor->node->id_unique;
                return $row;
            })
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at);
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
