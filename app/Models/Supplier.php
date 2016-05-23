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
}
