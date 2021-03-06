<?php

namespace App\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
	protected $table = 'master.barang';
	protected $primaryKey = 'kdbarang';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'kdbarang', 'kdkategori', 'namabarang', 'satuan', 'stokmin', 'hargajual'
	];

	private $rules = [
		'kdbarang'	=> 'sometimes|required|unique:pgsql.master.barang',
		'namabarang'=> 'required'
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

	public function kategories()
	{
		return $this->belongsTo('App\Models\Kategori', 'kdkategori');
	}

	public function suppliers()
	{
		return $this->belongsToMany('App\Models\Supplier', 'master.barangsupplier', 'kdbarang', 'kdsupplier')
			->withPivot('harga');
	}

	public function detailpembelian()
	{
		return $this->hasMany('App\Models\DetailPembelian', 'kdbarang');
	}

	public function getBarangtersedia($id, $term)
	{
		$query = DB::select("
            select barang.kdbarang as value, barang.namabarang as label from master.barang
            where barang.kdbarang not in (
                select barangsupplier.kdbarang from master.barangsupplier
                where barangsupplier.kdsupplier = '$id'
            )
            and LOWER(barang.namabarang) like '%$term%'
        ");

		return $query;
	}
}
