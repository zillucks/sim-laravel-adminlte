<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Karyawan extends Model
{
    protected $table = 'master.karyawan';
	protected $primaryKey = 'kdkaryawan';
	public $incrementing = false;
	public $timestamps = false;

	/**
	 * Define Validation Rule and Messages
	 * @var array
	 */
	private $rules = [
		'kdkaryawan' => 'sometimes|required|unique:pgsql.master.karyawan',
		'namadepan' => 'required',
		'namabelakang' => 'required',
		'email' => 'email|unique:pgsql.master.karyawan',
	];

	protected $messages = [
		'email' => 'Format Email Salah',
		'required' => ':attribute Wajib Diisi'
	];

	/**
	 * Define custom Validation
	 * @param $data
	 * @return mixed
	 */
	public function validate($data)
	{
		$validator = Validator::make($data, $this->rules, $this->messages);

		return $validator;
	}

	/**
	 * Define Relationships
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 * @return \Illuminate\Database\Eloquent\Relations\belongsTo
	 */
	public function users()
	{
		return $this->hasMany('App\Models\User', 'kdkaryawan');
	}

	public function jabatans()
	{
		return $this->belongsTo('App\Models\Jabatan', 'kdjabatan');
	}

	/**
	 * Define Accessor and Mutator
	 * @param $value
	 * @return string
	 */
	public function setKdKaryawan()
	{
		$lastcode = '000';

		$lastid = $this->orderBy('kdkaryawan', 'desc')
			->select('kdkaryawan')
			->first();

		$lastcodelastid = substr($lastid,-3);
		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastcode . $getlastcodeid, -3);
		$newkdkaryawan = 'KRY' . $newlastcode;

		return $newkdkaryawan;
	}

	public function setTgllahirAttribute($value)
	{
		$this->attributes['tgllahir'] = Carbon::createFromFormat('d-m-Y', $value)->toDateString();
	}

	public function getNoteleponAttribute($value)
	{
		$notelepon = !empty($value) ? $value : '-';

		return $this->attributes['notelepon'] = $notelepon;
	}

	public function getNohpAttribute($value)
	{
		$nohp = !empty($value) ? $value : '-';

		return $this->attributes['nohp'] = $nohp;
	}

	public function getTgllahirAttribute($value)
	{
		if(isset($value))
			return $this->attributes['tgllahir'] = Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
	}

	public function getNamalengkap()
	{
		return ucfirst($this->attributes['namadepan']) . ' ' . ucfirst($this->attributes['namabelakang']);
	}
}
