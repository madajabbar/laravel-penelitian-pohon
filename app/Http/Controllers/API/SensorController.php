<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\Sensor;
use App\Traits\CreateDataTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use CreateDataTrait;
    public function index()
    {
        //
        try{
            $user = Auth::user();
            if($user->is_admin == 'true'){
                $data = Sensor::all();
            }
            else{
                $data['node'] = Node::where('user_id',$user->id)->where('id_unique','like','%NM%')->first();
                $data['sensor'] = Sensor::whereIn('node_id',$user->node->pluck('id'))->get();
            }
            return ResponseFormatter::success($data);
        }
        catch(Exception $e){
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
        try{
            $request->validate(
                [
                    'node_id' => 'required',
                ]
            );
            $data = $this->CreateOrUpdateSensor($request);
            if($data == "error"){
                return ResponseFormatter::error('Sensor cannot more than 4 in every nodes');
            }
            else{
                return ResponseFormatter::success($data);
            }
        }
        catch(Exception $e){
            return ResponseFormatter::error($e->getMessage());
        }
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
            $data = Sensor::find($id)->delete();

            return ResponseFormatter::success($data);
        }
        catch(Exception $e){
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
