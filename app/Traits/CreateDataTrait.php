<?php

namespace App\Traits;

use App\Helpers\ResponseFormatter;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Sensor;
use App\Models\User;

trait CreateDataTrait
{
    public function CreateUser($data)
    {
        User::create($data);
    }
    public function CreateOrUpdateNode($data)
    {
        // dd($data->name);

        $last_node = Node::where('id_unique','LIKE','%'.$data->node_type.'%')->latest()->first();
        $id_unique = $data->node_type.str_pad(substr($last_node->id_unique,2)+1,3,0,STR_PAD_LEFT);
        $value = Node::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                'name' => $data->name,
                'id_unique' => $id_unique,
                'user_id' => $data->user_id,
            ]
        );
        return $value;
    }
    public function CreateOrUpdateSensor($data){
        // dd($data->name);
        $node = Node::find($data->node_id);
        $last_sensor = Sensor::where('node_id',$data->node_id)->latest()->get();
        if(count($last_sensor)>3){
            return 'error';
        }
        else{

            $id_unique = 'S'.(count($last_sensor)+1).'-'.$node->id_unique;
            $value = Sensor::updateOrCreate(
                [
                    'id' => $data->id,
                ],
                [
                    'name' => $data->name,
                    'id_unique' => $id_unique,
                    'node_id' => $data->node_id,
                ]
            );
        }
        return $value;

    }
    public function CreateOrUpdateRelay($data){
        // dd($data->name);
        $node = Node::find($data->node_id);
        $last_sensor = Relay::where('node_id',$data->node_id)->latest()->get();
        if(count($last_sensor)>3){
            return 'error';
        }
        else{
            $id_unique = 'R'.(count($last_sensor)+1).'-'.$node->id_unique;
            $value = Relay::updateOrCreate(
                [
                    'id' => $data->id,
                ],
                [
                    'name' => $data->name,
                    'id_unique' => $id_unique,
                    'node_id' => $data->node_id,
                ]
            );
        }
        return $value;
    }
}
