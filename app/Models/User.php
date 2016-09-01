<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $table = 'master.users';
	protected $primaryKey = 'username';
	public $incrementing = false;

	protected $fillable = [
		'username', 'kdevel', 'passcode',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'iduser', 'passcode', 'remember_token',
	];

	/**
	 * Overriding password fields
	 */
	public function getAuthPassword()
	{
		return $this->passcode;
	}

	public function hasLevel($role)
	{
		return $this->levels->level == $role ? true : false;
	}

	public function getLevel()
	{
		return $this->levels->level;
	}

	public function levels ()
	{
		return $this->belongsTo('App\Models\Level', 'kdlevel');
	}

	public function karyawans()
	{
		return $this->belongsTo('App\Models\Karyawan', 'kdkaryawan');
	}

	public function setPasscodeAttribute($value)
	{
		$this->attributes['passcode'] = bcrypt($value);
	}
}
