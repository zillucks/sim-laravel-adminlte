<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator;

class PembayaranPembelian extends Model
{
    protected $table = 'transaksi.pembayaranpembelian';
	protected $primaryKey = 'kdpembayaranpembelian';
	public $incrementing = false;
	public $timestamps = false;

	private $rules = [
		'jmlbayar' => 'numeric'
	];

	private $messages = [
		'jmlbayar.numeric' => 'Format Harus Angka'
	];

	public function validate($data)
	{
		$validator = Validator::make($data, $this->rules, $this->messages);

		return $validator;
	}
	
	/**
	 * @declare accessor and mutator
	 */
	
	public function setKdpembayaranpembelian()
	{
		$tgl = new \DateTime();
		$tgl->format('Ymd');

		$lastcode = '0000';

		$lastid = $this->where('kdpembayaranpembelian', 'like', $tgl->format('Ymd').'%')
			->orderBy('kdpembayaranpembelian', 'desc')
			->select('kdpembayaranpembelian')
			->first();

		$lastcodelastid = substr($lastid,-4);

		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastcode . $getlastcodeid, -4);

		$kdpembayaranpembelian = $tgl->format('Ymd') . $newlastcode;

		return $kdpembayaranpembelian;
	}

	public function setCreatedAtAttribute()
	{
		$this->attributes['created_at'] = Carbon::now();
	}

	/**
	 * @declare relationships
	 */

	public function pembelians()
	{
		return $this->belongsTo('App\Models\Pembelian', 'kdpembelian');
	}
}
