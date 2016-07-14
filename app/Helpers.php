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

class Helpers
{
    function getDataProduk($id = null)
    {
        $supplier = Supplier::find($id);
        $barang = Barang::has('suppliers', '<', 1)->get();
        $exists = $supplier->barangs()->get();
//    $produk = Barang::whereNotIn(function($query) {
//        //
//    });
        $produk = Barang::all();

        return $produk;
    }
}