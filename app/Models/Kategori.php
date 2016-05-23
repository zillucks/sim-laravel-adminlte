<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'master.kategori';
	protected $primaryKey = 'kdkategori';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'kdkategori', 'kategori'
	];

	public function barangs()
	{
		return $this->hasMany('App\Models\Barang', 'kdkategori');
	}
}
