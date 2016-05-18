<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LittleRed extends Model
{
    protected $fillable = ['little_red_name', 'blue_id', 'slug'];

    public function blue()
   {

       return $this->belongsTo('App\Blue');
   }
}