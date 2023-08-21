<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\Node;
use App\Models\Relay;
use App\Traits\CreateDataTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use CreateDataTrait;
    public function index()
    {
        try{
            $user = Auth::user();
            if($user->is_admin == 'true'){
                $data = Relay::all();
            }
            else{
                $data = Control::find($user->node[0]->control->id);
                $data->relay;
                $data->humidityTemperature;
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
            $data = $this->CreateOrUpdateRelay($request);
            if($data == "error"){
                return ResponseFormatter::error('Relay cannot more than 4 in every nodes');
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
            $data = Relay::find($id)->delete();

            return ResponseFormatter::success($data);
        }
        catch(Exception $e){
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
