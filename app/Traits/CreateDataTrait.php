<?php

namespace App\Traits;

use App\Helpers\ResponseFormatter;
use App\Models\Control;
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
    public function CreateOrUpdateControl($data)
    {
        $last_node = Control::latest()->first();
        $count = '00';
        if ($last_node != null) {
            $count = str_pad(substr($last_node->id_unique, 2) + 1, 3, 0, STR_PAD_LEFT);
        }
        $id_unique = 'NC' . $count;

        $data['control'] = Control::updateOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
                'id_unique' => $id_unique,
            ]
        );
        return $data;
    }
    public function CreateOrUpdateNode($data)
    {
        $last_node = Node::latest()->first();
        $count = '00';
        if ($last_node != null) {
            $count = str_pad(substr($last_node->id_unique, 2) + 1, 3, 0, STR_PAD_LEFT);
        }
        $id_unique = 'NM' . $count;
        // dd($id_unique);
        $data['node'] = Node::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                'name' => $data->name,
                'id_unique' => $id_unique,
                'user_id' => $data->user_id,
                'control_id' => $data->control_id,
            ]
        );
        for ($i = 0; $i < 4; $i++) {
            $last_sensor = Sensor::where('node_id', $data['node']->id)->orderBy('id', 'desc')->get();
            if (count($last_sensor) > 3) {
                return 'error';
            } else {
                $id_unique = 'S' . (count($last_sensor) + 1) . '-' . $data['node']->id_unique;
                $data['sensor'] =  Sensor::create(
                    [
                        'name' => 'Pot ' . (count($last_sensor) + 1),
                        'id_unique' => $id_unique,
                        'node_id' => $data['node']->id,
                    ]
                );
            }
        }
        return $data;
    }
    public function CreateOrUpdateSensor($data)
    {
        // dd($data->name);
        $node = Node::find($data->node_id);
        $last_sensor = Sensor::where('node_id', $data->node_id)->latest()->get();
        if (count($last_sensor) > 3) {
            return 'error';
        } else {

            $id_unique = 'S' . (count($last_sensor) + 1) . '-' . $node->id_unique;
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
    public function CreateOrUpdateRelay($data)
    {
        // dd($data->name);
        $node = Control::find($data->control_id);
        $last_sensor = Relay::where('control_id', $data->control_id)->latest()->get();

        $id_unique = 'R' . (count($last_sensor) + 1) . '-' . $node->id_unique;
        $value = Relay::updateOrCreate(
            [
                'id' => $data->id,
            ],
            [
                'name' => $data->name,
                'id_unique' => $id_unique,
                'control_id' => $data->control_id,
            ]
        );
        return $value;
    }
}
