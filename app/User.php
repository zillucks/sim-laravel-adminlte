<?php

namespace App;

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
	protected $incrementing = false;

	protected $fillable = [
		'username', 'kdevel', 'passcode',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'passcode', 'remember_token',
	];

	public function level ()
	{
		return $this->belongsTo('App\Models\Level', 'kdlevel');
	}
}
