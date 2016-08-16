<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = 'transaksi.detailpemesananpembelian';
	protected $primaryKey = 'kddetailpembelian';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'kdpembelian', 'kdbarang', 'qty', 'total', 'diskonitem'
	];

	private $rules = [
		'kddetailpembelian'	=> 'sometimes|required|unique:pgsql.transaksi.detailpemesananpembelian',
	];

	/**
	 * @declare accessor and mutator
	 */

	public function setKddetailpembelianAttribute($value)
	{
		$tgl = new \DateTime();
		$tgl->format('ymd');

		$firstkdpembelian = (int)substr($value,-4);

		$headkddetail = 'DP';
		$firstkddetail = '00';
		$lastkddetail = '0000';

		$getfirstkddetail = (int)$firstkddetail+$firstkdpembelian;
		$firstkddetail = substr($firstkddetail . $getfirstkddetail, -2);
		$firstkddetail = $headkddetail . $firstkddetail . $tgl->format('ymd');

		$lastid = $this->where([
			['kdpembelian', $value],
			['kddetailpembelian', 'like', $firstkddetail.'%']
		])
			->orderBy('kddetailpembelian', 'desc')
			->select('kddetailpembelian')
			->first();

		$lastcodelastid = substr($lastid,-4);
		$getlastcodeid = (int)$lastcodelastid + 1;
		$newlastcode = substr($lastkddetail . $getlastcodeid, -4);

		$kddetailpembelian = $firstkddetail . $newlastcode;

		$this->attributes['kddetailpembelian'] = $kddetailpembelian;
	}

	public function getDiskonitemAttribute($value)
	{
		return $this->attributes['diskonitem'] = $value . '%';
	}


	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 * @declare relationships
	 */

	public function pembelians()
	{
		return $this->belongsTo('App\Models\Pembelian', 'kdpembelian');
	}

	public function barangs()
	{
		return $this->belongsTo('App\Models\Barang', 'kdbarang');
	}
}
