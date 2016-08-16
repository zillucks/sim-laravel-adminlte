<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPembelian;
use App\Models\PembayaranPembelian;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TransaksiController extends Controller
{
    public function pemesananpembelian()
    {
		$startdate = Input::get('startdate');
		$enddate = Input::get('enddate');

		$pembelian	= Pembelian::when($startdate, function ($query) use($startdate, $enddate) {
			return $query->whereBetween('tglpembelian', [$startdate, $enddate]);
		})
			->orderBy('tglpembelian', 'asc')->paginate(10);
        return view('transaksi.pemesananpembelian', compact('pembelian', 'startdate', 'enddate'));
    }

	public function tambahpemesananpembelian()
	{
		return view('transaksi.tambahpemesananpembelian');
    }

	public function simpanpemesananpembelian(Request $request, Pembelian $pembelian)
	{
		$validator = $pembelian->validate($request->all());

		if($validator->fails()){
			return redirect()->back()
				->withErrors($validator);
		}

		$pembelian->kdpembelian = $pembelian->setKdpembelian($request->tglpembelian);
		$pembelian->tglpembelian = $request->tglpembelian;
		$pembelian->nofaktur = $request->nofaktur;
		$pembelian->kdsupplier = $request->kdsupplier;
		$pembelian->jenispembelian = $request->jenispembelian;
		$pembelian->tgljatuhtempo = $request->tgljatuhtempo;
		$pembelian->subtotal = $request->grandtotal;
		$pembelian->bayar = 0;
		$pembelian->diskontransaksi = $request->diskontransaksi;
		$pembelian->iduser = Auth::user()->iduser;

		DB::transaction(function () use ($pembelian, $request) {
			$pembelian->save();

			foreach ($request->kdbarang as $item => $value) {
				$detailpembelian = new DetailPembelian();

				$detailpembelian->kddetailpembelian = $pembelian->kdpembelian;
				$detailpembelian->kdbarang = $value;
				$detailpembelian->qty = $request->qty[$item];
				$detailpembelian->total = $request->subtotal[$item];
				$detailpembelian->diskonitem = $request->diskonitem[$item];

				$barang = Barang::find($value);
				$barang->stok += $request->qty[$item];

				$barang->update();
				$pembelian->detailpembelian()->save($detailpembelian);
			}
		});
		
		return redirect()->route('transaksi.pemesananpembelian')->with('success', 'Input Data PO Sukses');
		
	}

	public function detailpemesananpembelian($id)
	{
		$pembelian = Pembelian::with('suppliers', 'detailpembelians.barangs.suppliers')->find($id);
		return view('transaksi.detailpemesananpembelian', compact('pembelian'));
	}

	public function pembayaranpembelian($kdpembelian = null)
	{
		$data['kdpembelian'] = $kdpembelian;
		$data['pembelian'] = Pembelian::with('suppliers')
			->orderBy('nofaktur', 'asc')
			->orderBy('tgljatuhtempo', 'asc')
			->paginate(10);

		if(isset($kdpembelian)){
			$data['pembelian'] = Pembelian::with('suppliers', 'detailpembelians.barangs')->find($kdpembelian);
			return view('transaksi.formpembayaran', $data);
		}

		return view('transaksi.pembayaranpembelian', $data);
	}
	
	public function prosespembayaran(Request $request, PembayaranPembelian $pembayaranPembelian, $kdpembelian)
	{
		$validator = $pembayaranPembelian->validate($request->all(),$kdpembelian);

		$pembelian = Pembelian::find($kdpembelian);

		if($validator->fails()){
			return redirect()->back()
				->withErrors($validator);
		}

		$pembayaranPembelian->kdpembayaranpembelian = $pembayaranPembelian->setKdpembayaranpembelian();
		$pembayaranPembelian->kdpembelian = $kdpembelian;
		$pembayaranPembelian->tglbayar = date('Y-m-d');
		$pembayaranPembelian->jmlbayar = $request->jmlbayar;

		DB::transaction(function ()use ($request, $pembelian, $pembayaranPembelian) {
			$pembayaranPembelian->save();

			$pembelian->bayar += $request->jmlbayar;

			$pembelian->save();
		});

		return redirect()->route('transaksi.pembayaranpembelian')->with('success', 'Proses Pembayaran Berhasil');
	}

    public function penjualan()
    {
        return view('transaksi.penjualan');
    }

	public function autosupplier()
	{
		$term = strtolower(Input::get('term'));

		$query = Supplier::whereRaw("lower(namasupplier) like '%$term%'")
			->orWhereRaw("lower(kdsupplier) like '%$term%'")
			->get(['namasupplier as label', 'kdsupplier as value']);

		return $query;
	}

	public function autocompletebarangsupplier()
	{
		$id = Input::get('id');
		$term = strtolower(Input::get('term'));

		$query = DB::table("master.barangsupplier as t1")
			->join("master.barang as t2", "t1.kdbarang", "=", "t2.kdbarang")
			->join("master.supplier as t3", "t1.kdsupplier", "=", "t3.kdsupplier")
			->where("t1.kdsupplier", $id)
			->whereRaw("lower(t2.namabarang) like '%$term%'")
			->orWhereRaw("lower(t2.kdbarang) like '%$term%'")
			->selectRaw("t2.namabarang, concat(t2.kdbarang, ' - ', t2.namabarang) as label, t1.kdbarang as value, t1.harga")
			->get();

		return $query;
	}
}
