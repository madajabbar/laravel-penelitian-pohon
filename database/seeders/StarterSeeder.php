<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $start = microtime(true);
        print($start);
        for ($i = 1; $i < 11; $i++) {
            $user = User::create(
                [
                    'name' => 'user_'.$i,
                    'email' => 'user'.$i.'@example.com',
                    'password' => Hash::make('rahasia123'),
                    'is_admin' => 'false',
                ]
            );
            $unique_node = str_pad($i,3,0,STR_PAD_LEFT);
            $node = Node::create(
                [
                    'id_unique' => 'NM'.$unique_node,
                    'name' => 'Node '.'NM'.$unique_node,
                    'user_id' => $user->id,
                ]
            );
            for($k=1;$k<5;$k++){
                $sensor = Sensor::create(
                    [
                        'id_unique' => 'S'.$k.'-NM'.$unique_node,
                        'name' => 'Pot S'.$k.'-NM'.$unique_node,
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'node_id' => $node->id,
                    ]
                );
            }
            $node = Node::create(
                [
                    'id_unique' => 'NC'.$unique_node,
                    'name' => 'Node '.'NC'.$unique_node,
                    'user_id' => $user->id,
                ]
            );
            for($j=1;$j<5;$j++){
                $relay = Relay::create(
                    [
                        'id_unique' => 'R'.$j.'-NC'.$unique_node,
                        'name' => 'Pompa Solenoid R'.$j.'-NC'.$unique_node,
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                        'node_id' => $node->id,
                    ]
                );
            }
        }

        $sensor = Sensor::pluck('id');
        $arr_sensor = $sensor->all();
        for ($i = 0; $i<10000;$i++){
            Log::create(
                [
                    'sensor_id' => $arr_sensor[rand(0, count($arr_sensor) - 1)],
                    'soil_moisture' => rand(20,60),
                    'humidity' => rand(70,90),
                    'temperature' => rand(22,38),
                ]
            );
        }
        $time_elapsed_secs = microtime(true) - $start;
        print($time_elapsed_secs);
    }
}
