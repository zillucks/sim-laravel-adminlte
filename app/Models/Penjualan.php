<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'transaksi.penjualan';
    protected $primaryKey = 'kdpenjualan';
    public $incrementing = false;

    private $rules = [
        'kdpenjualan'	=> 'sometimes|required|unique:pgsql.transaksi.penjualan',
        'nofaktur'  	=> 'sometimes|unique:pgsql.transaksi.penjualan',
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

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}
