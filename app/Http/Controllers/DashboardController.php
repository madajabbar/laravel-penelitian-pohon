<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Node;
use App\Models\Relay;
use App\Models\Sensor;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['title'] = 'Dashboard';
        $data['node'] = Count(Node::all());
        $data['sensor'] = Count(Sensor::all());
        $data['relay'] = Count(Relay::all());
        $data['user'] = Count(User::all());
        $data['log'] = Log::orderBy('id','desc')->take(3)->get();
        return view('backend.dashboard.index',$data);
    }
    public function value(){
        $humidity = Log::orderBy('id','desc')->take(10)->pluck('humidity');
        $time = Log::orderBy('id','desc')->take(10)->pluck('created_at');
        return [$humidity, $time];
    }
}
