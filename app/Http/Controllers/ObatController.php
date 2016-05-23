<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class ObatController extends Controller
{
	public function __construct()
	{
		//
    }

	public function index()
	{
		$data['obats'] = Barang::paginate(10);
		$data['ddlkategori'] = Kategori::lists('kategori', 'kdkategori');
		return view('obat.obat', $data);
	}

	public function kategori(Request $request)
	{
		$data['kategories'] = Kategori::orderBy('kategori', 'asc')->paginate(10);

		if($request->isMethod('post'))
		{
			/*
			 * create validation
			 */
			$validator = Validator::make($request->all(), [
				'kdkategori' => 'required|max:255',
				'kategori' => 'required',
			]);

			if ($validator->fails()) {
				return redirect()->back()
					->withErrors($validator)
					->withInput();
			}

			$kategori = Kategori::firstOrNew([
				'kdkategori' => $request->kdkategori,
			]);
			$kategori->kategori = $request->kategori;
			$kategori->save();

			return redirect()->back()->with([
				'success' => 'Input/Update Data ' .$kategori->kategori. ' Sukses'
			]);
		}

		return view('obat.kategori', $data);
	}

	public function updatekategori(Request $request)
	{
		$kategori = Kategori::find($request->pk);
		$name = $request->get('name');
		$value = $request->get('value');
		$kategori->$name = $value;

		$kategori->save();
	}

	public function hapuskategori(Request $request, Kategori $kategori)
	{
		Kategori::destroy($kategori->kdkategori);

		return redirect()->route('obat::kategori')->with([
			'danger'	=> 'Proses Hapus Data Berhasil'
		]);
	}

	public function viewobat(Barang $obat, $id = null)
	{
		$data['ddlkategori'] = Kategori::orderBy('kategori', 'asc')->lists('kategori', 'kdkategori');
		return view('obat.viewobat', $data);
	}

	public function saveobat(Request $request, Barang $obat)
	{
		$obat->kdbarang = $request->kdbarang;
		$obat->kdkategori = $request->kdkategori;
		$obat->namabarang = $request->namabarang;
		$obat->satuan = $request->satuan;
		$obat->stokmin = $request->stokmin;

		$validator = $obat->validate($request->all());
		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput();
		}
		else{
			$obat->save();

			return redirect()->route('obat::obat')->with([
				'success' => 'Input/Update Data Sukses'
			]);
		}
	}

	public function updateobat(Request $request)
	{
		$obat = Barang::find($request->pk);
		$name = $request->get('name');
		$value = $request->get('value');
		$obat->$name = $value;

		$obat->save();
	}
}
