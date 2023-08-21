<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function node(){
        return $this->belongsTo(Node::class);
    }
    public function log(){
        return $this->hasMany(Log::class);
    }
    public function soil(){
        return $this->hasOne(Soil::class);
    }
}
