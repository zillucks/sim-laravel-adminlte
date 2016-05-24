<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Supplier extends Model
{
	protected $table = 'master.supplier';
	protected $primaryKey = 'kdsupplier';
	public $incrementing = false;
	public $timestamps = false;

	private $rules = [
		'kdsupplier'	=> 'sometimes|required|unique:pgsql.master.supplier',
		'namasupplier'	=> 'sometimes|required',
		'nohp'			=> 'required',
		'email'			=> 'sometimes|unique:pgsql.master.supplier|email',
	];

	private $messages = [
		'required'	=> 'Wajib diisi',
		'unique'	=> 'Kode Sudah terpakai'
	];

	public function validate($data)
	{
		$validator = Validator::make($data, $this->rules, $this->messages);

		return $validator;
	}

	/*
	public function getNamasupplierAttribute($value)
	{
		$slug = str_slug($value);
		$data = [
			'slug' => $slug,
			'value'=> $value
		];
		return $data;
	}
	*/

	public function barangs()
	{
		return $this->belongsToMany('App\Models\Barang', 'master.barangsupplier', 'kdsupplier', 'kdbarang')
			->withPivot('harga');
	}

}
