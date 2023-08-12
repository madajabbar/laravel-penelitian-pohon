<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Control;
use App\Models\HumidityTemperature;
use App\Models\Log;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Sensor;
use App\Models\Soil;
use App\Models\Temp;
use App\Models\Threshold;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EdgeController extends Controller
{
    public function index()
    {
        $data['threshold'] = Threshold::all();
        $data['node'] = Node::all();
        $data['sensor'] = Sensor::all();
        $data['relay'] = Relay::all();

        return ResponseFormatter::success($data);
    }
    public function soil(Request $request)
    {
        $now = Carbon::now();
        $roundedMinutes = $now->minute - ($now->minute % 15);
        $time = Carbon::create($now->year, $now->month, $now->day, $now->hour, $roundedMinutes);
        try {
            $request->validate(
                [
                    'sensor_id' => 'required',
                    'value' => 'required',
                ]
            );
            $i = 0;
            $tmp = [];
            $threshold = Threshold::first();
            foreach ($request->sensor_id as $soil) {
                // return $request['value'][$i];
                $temp = Temp::where('id_unique', $request['sensor_id'][$i])->first();
                $sensor = Sensor::where('id_unique', $request['sensor_id'][$i])->first();
                $node = $sensor->node;
                if ($temp == null) {
                    Temp::create(
                        [
                            'id_unique' => $request['sensor_id'][$i],
                            'value' => $request['value'][$i]
                        ]
                    );
                    $data[] = Soil::create(
                        [
                            'id_unique' => $request['sensor_id'][$i],
                            'value' => $request['value'][$i]
                        ]
                    );
                }
                if (abs($request['value'][$i] - $temp->value) >= $threshold->soil_moisture) {
                    $tmp = abs($request['value'][$i] - $temp->value);
                    $temp->value = $request['value'][$i];
                    $temp->save();
                    $data[] = Soil::updateOrCreate(
                        [
                            'id_unique' => $request['sensor_id'][$i]
                        ],
                        [
                            'id_unique' => $request['sensor_id'][$i],
                            'value' => $request['value'][$i],
                            'sensor_id' => $sensor->id,
                        ]
                    );
                }
                $nowQuarter = (int) ceil($now->minute / 15);
                $log = Log::where('sensor_id', $sensor->id)->orderBy('id', 'DESC')->first();
                $humidityTemperature = HumidityTemperature::where('control_id', $sensor->node->control->id)->first();
                if ($log == null) {
                    Log::create(
                        [
                            'sensor_id' => $sensor->id,
                            'soil_moisture' => $request['value'][$i],
                            'humidity' => $humidityTemperature ? $humidityTemperature->humidity : null,
                            'temperature' => $humidityTemperature ? $humidityTemperature->temperature : null,
                            'time' => $time,
                            'quarter' => $nowQuarter,
                        ]
                    );
                } else {
                    $quarter = $log->quarter;
                    if ($nowQuarter != $quarter) {
                        Log::create(
                            [
                                'sensor_id' => $sensor->id,
                                'soil_moisture' => $request['value'][$i],
                                'time' => $time,
                                'quarter' => $nowQuarter,
                                'humidity' => $humidityTemperature ? $humidityTemperature->humidity : null,
                                'temperature' => $humidityTemperature ? $humidityTemperature->temperature : null,
                            ]
                        );
                    }
                }
                $i++;
            }
            return response()->json($tmp);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }
    public function humiditytemperature(Request $request)
    {
        // return $request['humidity'];
        $control = Control::where('id_unique',$request['control_id'])->first();
        // return $control->id;
        $data = HumidityTemperature::updateOrCreate(
            [
                'control_id' => $control->id,
            ],
            [
                'control_id' => $control->id,
                'humidity' => $request['humidity'],
                'temperature' => $request['temperature'],
            ]
        );

        return response()->json($control->relay);
    }
    public function edgeSoil(Request $request)
    {

        // return response()->json($request[0][]);
        $now = Carbon::now();
        $roundedMinutes = $now->minute - ($now->minute % 15);
        $time = Carbon::create($now->year, $now->month, $now->day, $now->hour, $roundedMinutes);
        try {
            $tmp = [];
            $threshold = Threshold::first();
            $i = 0;
            $data = [];
            foreach($request[0] as $value) {
                // return response()->json($value['sensor_id']);
                $temp = Temp::where('id_unique', $value['sensor_id'])->first();
                $sensor = Sensor::where('id_unique', $value['sensor_id'])->first();
                $node = $sensor->node;
                if ($temp == null) {
                    Temp::create(
                        [
                            'id_unique' => $value['sensor_id'],
                            'value' => $value['value']
                        ]
                    );
                    $data[] = Soil::create(
                        [
                            'id_unique' => $value['sensor_id'],
                            'value' => $value['value']
                        ]
                    );
                }
                if (abs($value['value'] - $temp->value) >= $threshold->soil_moisture) {
                    $tmp = abs($value['value'] - $temp->value);
                    $temp->value = $value['value'];
                    $temp->save();
                    $data[] = Soil::updateOrCreate(
                        [
                            'id_unique' => $value['sensor_id']
                        ],
                        [
                            'id_unique' => $value['sensor_id'],
                            'value' => $value['value'],
                            'sensor_id' => $sensor->id,
                        ]
                    );
                }
                $nowQuarter = (int) ceil($now->minute / 15);
                $log = Log::where('sensor_id', $sensor->id)->orderBy('id', 'DESC')->first();
                $humidityTemperature = HumidityTemperature::where('control_id', $sensor->node->control->id)->first();
                if ($log == null) {
                    Log::create(
                        [
                            'sensor_id' => $sensor->id,
                            'soil_moisture' => $value['value'],
                            'humidity' => $humidityTemperature ? $humidityTemperature->humidity : null,
                            'temperature' => $humidityTemperature ? $humidityTemperature->temperature : null,
                            'time' => $time,
                            'quarter' => $nowQuarter,
                        ]
                    );
                } else {
                    $quarter = $log->quarter;
                    if ($nowQuarter != $quarter) {
                        Log::create(
                            [
                                'sensor_id' => $sensor->id,
                                'soil_moisture' => $value['value'],
                                'time' => $time,
                                'quarter' => $nowQuarter,
                                'humidity' => $humidityTemperature ? $humidityTemperature->humidity : null,
                                'temperature' => $humidityTemperature ? $humidityTemperature->temperature : null,
                            ]
                        );
                    }
                }
                $i++;
            }
            return response()->json($data);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
        return response()->json('akhir');
    }
}
