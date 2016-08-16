<?php
/**
 * Created by PhpStorm.
 * User: zillucks
 * Date: 6/1/2016
 * Time: 9:22 PM
 */

namespace App\Helpers;
use App\Models\Supplier;
use App\Models\Barang;
use Carbon\Carbon;

class Helpers
{
	protected $month = ['01'=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    function getDataProduk($id = null)
    {
        $supplier = Supplier::find($id);
        $barang = Barang::has('suppliers', '<', 1)->get();
        $exists = $supplier->barangs()->get();
        $produk = Barang::all();

        return $produk;
    }

	public function toLocalDate($value)
	{
		$date = Carbon::parse($value);

		$newdate = $date->day . ' ' . $this->month[$date->month] . ' ' . $date->year;

		return $newdate;
    }
}