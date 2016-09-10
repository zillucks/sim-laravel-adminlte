<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Penjualan extends Model
{
    protected $table = 'transaksi.penjualan';
    protected $primaryKey = 'kdpenjualan';
    public $incrementing = false;

    private $rules = [
        'kdpenjualan'	=> 'sometimes|required|unique:pgsql.transaksi.penjualan',
        'nofaktur'  	=> 'sometimes|required|unique:pgsql.transaksi.penjualan',
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
	 * @param $data
	 * @return string
	 * describe accessor and mutator
	 */
	public function setKdpenjualan($data)
	{
		$tgl = explode('-', $data);
		$tgl = substr($tgl[2],-2).$tgl[1].$tgl[0];
		$headcode = 'PO' . $tgl;
		$lastcode = '0000';

		$lastid = $this->where('kdpenjualan', 'like', $headcode.'%')
			->orderBy('kdpenjualan', 'desc')
			->select('kdpenjualan')
			->first();

		$lastcodelastid = substr($lastid,-4);

		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastcode . $getlastcodeid, -4);

		$kdpenjualan = $headcode . $newlastcode;

		return $kdpenjualan;
	}

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'iduser');
    }

	public function pelanggans()
	{
		return $this->belongsTo('App\Models\Pelanggan', 'kdpelanggan');
	}

	public function detailpenjualans()
	{
		return $this->hasMany('App\Models\DetailPenjualan', 'kdpenjualan');
	}

}
