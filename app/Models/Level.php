<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'master.level';
    protected $primaryKey = 'kdlevel';
    public $incrementing = false;
    public $timestamps = false;

    public function users()
    {
    	return $this->hasMany('App\Models\User', 'kdlevel');
    }
}
