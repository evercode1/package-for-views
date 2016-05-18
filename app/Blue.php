<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blue extends Model
{
    protected $fillable = ['blue_name', 'slug'];

    public function littleReds()
    {

        return $this->hasMany('App\LittleRed');
    }
}