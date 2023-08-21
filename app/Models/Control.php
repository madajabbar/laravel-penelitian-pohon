<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function node(){
        return $this->hasMany(Node::class);
    }

    public function relay(){
        return $this->hasMany(Relay::class);
    }
    public function humidityTemperature(){
        return $this->hasOne(HumidityTemperature::class);
    }


}
