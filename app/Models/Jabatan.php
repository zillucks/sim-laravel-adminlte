<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'master.jabatan';
	protected $primaryKey = 'kdjabatan';
	public $incrementing = false;
	public $timestamps = false;

	public function karyawans()
	{
		return $this->hasMany('App\Models\Karyawan', 'kdjabatan');
	}
}
