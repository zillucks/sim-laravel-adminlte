<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'master.pelanggan';
	protected $primaryKey = 'kdpelanggan';
	public $incrementing = false;

	public function penjualans()
	{
		return $this->hasMany('App\Models\Penjualan', 'kdpelanggan');
	}
}
