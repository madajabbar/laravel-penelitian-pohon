<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Node;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            if ($user->is_admin == 'true') {
                $data = Log::all();
            } else {
                $node = Node::where('user_id', $user->id)->where('id_unique', 'like', '%NM%')->first();
                $data = Log::whereIn('sensor_id', $node->sensor->pluck('id'))->get()->sortDesc();
            }
            return ResponseFormatter::success([$data]);
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

        }
        catch(Exception $e){
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
