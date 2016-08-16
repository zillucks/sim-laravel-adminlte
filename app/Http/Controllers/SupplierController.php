<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Barangsupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Session\Session;

class SupplierController extends Controller
{
	public function index()
	{
		$data['suppliers'] = Supplier::orderBy('namasupplier', 'asc')->paginate(10);

		return view('supplier.index', $data);
    }

	public function tambahsupplier()
	{
		$data = [];
		return view('supplier.tambahsupplier', $data);
	}

	public function savesupplier(Request $request, Supplier $supplier)
	{
		$validator = $supplier->validate($request->all());

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}

		$supplier->kdsupplier = $request->kdsupplier;
		$supplier->namasupplier = $request->namasupplier;
		$supplier->contactperson = $request->contactperson;
		$supplier->notelp = $request->notelp;
		$supplier->nohp = $request->nohp;
		$supplier->email = $request->email;
		$supplier->alamat = $request->alamat;
		$supplier->kota = $request->kota;
		$supplier->propinsi = $request->propinsi;

		$supplier->save();

		return redirect()->to('supplier')->with([
			'success' => 'Input Data Supplier Sukses'
		]);
	}

	public function updatesupplier(Request $request)
	{
		$supplier = Supplier::find($request->pk);

		$name = $request->get('name');
		$value = $request->get('value');
		$supplier->$name = $value;

		$supplier->save();
	}

	public function tambahproduk(Request $request, $id)
	{
		$data['supplier'] = Supplier::find($id);
		return view('supplier.tambahproduk', $data);
	}

    public function saveproduk(Request $request, $id)
    {
        $supplier = Supplier::find($id);
        $sentdata = $request->get('sentdata');
        $totalitem = count($sentdata);
        $data['response'] = 'failure';
        $data['location'] = '';
        foreach ($sentdata as $index => $item) {
            $kdbarang[$index] = $item['kdbarang'];
            $harga[$index] = $item['harga'];
            $supplier->barangs()->attach($kdbarang[$index], ['harga' => $harga[$index]]);

            $lastitem = $index+1;
            if($totalitem === $lastitem){
                $data['response'] = 'success';
                $data['location'] = route('supplier::supplier');
            }
        }

        return response()->json($data);
    }

	public function autocompleteproduk($id)
	{
        $term = strtolower(Input::get('term'));

        $produktersedia = $query = DB::select("
            select barang.kdbarang as value, barang.namabarang as label from master.barang
            where LOWER(barang.namabarang) like '%$term%'
            and barang.kdbarang not in (
                select barangsupplier.kdbarang from master.barangsupplier
                where barangsupplier.kdsupplier = '$id'
            )
        ");

		return $produktersedia;
	}

	public function androidsupplier()
	{
		$supplier = Supplier::all();

		return $supplier;
	}
}
