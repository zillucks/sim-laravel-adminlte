<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Validator;

class Pembelian extends Model
{
    protected $table = 'transaksi.pemesananpembelian';
    protected $primaryKey = 'kdpembelian';
    public $incrementing = false;

    private $rules = [
        'kdpembelian'	=> 'sometimes|required|unique:pgsql.transaksi.pemesananpembelian',
        'nofaktur'  	=> 'sometimes|unique:pgsql.transaksi.pemesananpembelian',
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

	/**
	 * @param $value
	 * @return string
	 * @set accessor and mutator
	 */

	public function setKdpembelian($data)
	{
		$tgl = explode('-', $data);
		$tgl = substr($tgl[2],-2).$tgl[1].$tgl[0];
		$headcode = 'PO' . $tgl;
		$lastcode = '0000';

		$lastid = $this->where('kdpembelian', 'like', $headcode.'%')
			->orderBy('kdpembelian', 'desc')
			->select('kdpembelian')
			->first();

		$lastcodelastid = substr($lastid,-4);

		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastcode . $getlastcodeid, -4);

		$kdpembelian = $headcode . $newlastcode;

		return $kdpembelian;
	}

	public function setTglpembelianAttribute($value)
	{
		$this->attributes['tglpembelian'] = Carbon::createFromFormat('d-m-Y', $value)->toDateString();
	}

	public function getTglpembelianAttribute($value)
	{
		return $this->attributes['tglpembelian'] = toLocaleDate($value);
	}

	public function getTgljatuhtempoAttribute($value)
	{
		return $this->attributes['tgljatuhtempo'] = toLocaleDate($value);
	}

	public function getDiskontransaksiAttribute($value)
	{
		return $this->attributes['diskontransaksi'] = $value . '%';
	}

	public function getTotalhutang($subtotal, $bayar)
	{
		$totalhutang = (int)$subtotal - (int)$bayar;
		return $totalhutang;
	}

	/**
	 * @declare relationships
	 */
	public function detailpembelians()
	{
		return $this->hasMany('App\Models\DetailPembelian', 'kdpembelian');
	}

	public function suppliers()
	{
		return $this->belongsTo('App\Models\Supplier', 'kdsupplier');
	}

	public function pembayaranpembelians()
	{
		return $this->hasMany('App\Models\PembayaranPembelian', 'kdpembelian');
	}
}