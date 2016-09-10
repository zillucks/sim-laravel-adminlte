<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'transaksi.detailpenjualan';
	protected $primaryKey = 'kddetailpenjualan';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'kdpenjualan', 'kdbarang', 'qty', 'total'
	];

	private $rules = [
		'kddetailpenjualan' => 'sometimes|required|unique:pgsql.transaksi.detailpenjualan'
	];

	public function setKddetailpenjualanAttribute($value)
	{
		$tgl = new \DateTime();
		$tgl->format('ymd');

		$firstkdpenjualan = (int)substr($value,-4);

		$headkddetail = 'DPJ';
		$firstkddetail = '00';
		$lastkddetail = '000';

		$getfirstkddetail = (int)$firstkddetail+$firstkdpenjualan;
		$firstkddetail = substr($firstkddetail . $getfirstkddetail, -2);
		$firstkddetail = $headkddetail . $firstkddetail . $tgl->format('ymd');

		$lastid = $this->where([
			['kdpenjualan', $value],
			['kddetailpenjualan', 'like', $firstkddetail.'%']
		])
			->orderBy('kddetailpenjualan', 'desc')
			->select('kddetailpenjualan')
			->first();

		$lastcodelastid = substr($lastid,-3);
		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastkddetail . $getlastcodeid, -3);

		$kddetailpenjualan = $firstkddetail . $newlastcode;

		$this->attributes['kddetailpenjualan'] = $kddetailpenjualan;
	}

	public function penjualans()
	{
		return $this->belongsTo('App\Models\Penjualan', 'kdpenjualan');
	}

	public function barangs()
	{
		return $this->belongsTo('App\Models\Barang', 'kdbarang');
	}
}
