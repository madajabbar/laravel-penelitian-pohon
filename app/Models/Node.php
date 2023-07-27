<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function relay(){
        return $this->hasMany(Relay::class);
    }
    public function sensor(){
        return $this->hasMany(Sensor::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
