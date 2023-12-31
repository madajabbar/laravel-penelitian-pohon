<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiNodeResource;
use App\Models\Node;
use App\Traits\CreateDataTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use CreateDataTrait;
    public function index()
    {
        try {
            $user = Auth::user();

            if (Auth::user()->is_admin == "true") {
                $data = Node::all();
            } else {
                $data = Node::where('user_id', $user->id)->get();
                $data = ApiNodeResource::collection($data);
            }

            return ResponseFormatter::success($data);
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
        try {
            $request->validate(
                [
                    'user_id' => 'required',
                ]
            );

            $data = $this->CreateOrUpdateNode($request);

            return ResponseFormatter::success($data);
        } catch (Exception $e) {
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
            $data = Node::find($id)->delete();

            return ResponseFormatter::success($data);
        }
        catch(Exception $e){
            return ResponseFormatter::error($e->getMessage());
        }
    }
}
