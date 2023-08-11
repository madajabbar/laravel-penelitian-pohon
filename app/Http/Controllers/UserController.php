<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\HumidityTemperature;
use App\Models\Log;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Sensor;
use App\Models\Soil;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->is_admin == 'true'){
            // return redirect(route('dashboard.index'));
        }
        $data['node'] = Node::where('user_id',Auth::user()->id)->where('id_unique','like','%NM%')->get();
        $data['sensor'] = Sensor::where('node_id', $data['node'][0]->id)->first();
        if($request->id_unique){
            $data['sensor'] = Sensor::where('id_unique', $request->id_unique)->first();
        }
        $control_id = $data['node']->pluck('id');
        $control = Control::whereIn('id',$control_id)->pluck('id');
        $data['relay'] = Relay::whereIn('control_id',$control)->get();
        $data['log'] = Log::where('sensor_id',$data['sensor']->id)->orderBy('id','desc')->take(7)->get();
        $data['now'] = Log::where('sensor_id',$data['sensor']->id)->orderBy('id','desc')->first();
        // dd($data['log']);
        $data['title'] = $data['sensor']->name;

        return view('user.index',$data);
    }
    public function soil(Request $request,$id){
        $data = Soil::where('sensor_id',$id)->first();
        return $data;
    }
    public function humidityTemperature(Request $request,$id){
        $data = HumidityTemperature::where('control_id',$id)->first();
        return $data;
    }
    public function temperature(Request $request){}
    public function log(Request $request){
        $data = Log::with(['sensor','sensor.node'])->orderBy('id','desc')->take(3)->get();
        return response()->json($data);
    }


}
