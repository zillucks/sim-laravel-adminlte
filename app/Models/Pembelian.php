<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'transaksi.pemesananpembelian';
    protected $primaryKey = 'kdpembelian';
    public $incrementing = false;

    private $rules = [
        'kdpembelian'	=> 'sometimes|required|unique:pgsql.transaksi.pemesananpembelian',
        'nofaktur'  	=> 'sometimes|unique:pgsql.transaksi.pemesananpembelian',
    ];
}
