<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'master.karyawan';
	protected $primaryKey = 'kdkaryawan';
	public $incrementing = false;
	public $timestamps = false;

	public function users()
	{
		return $this->hasMany('App\Models\User', 'kdkaryawan');
	}

	public function jabatans()
	{
		return $this->belongsTo('App\Models\Jabatan', 'kdjabatan');
	}
}
