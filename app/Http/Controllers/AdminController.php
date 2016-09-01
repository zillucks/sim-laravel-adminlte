<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Level;
use App\Models\User;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AdminController extends Controller
{
	public function __construct()
	{
//		$this->middleware('auth');
    }

	public function index()
	{
		//
	}

	public function karyawan()
	{
		$data['karyawans'] = Karyawan::with(['jabatans' => function ($query) {
			$query->orderBy('kdjabatan', 'asc');
		}])->paginate(10);

		return view('admin.karyawan', $data);
	}

	public function tambahkaryawan(Request $request, Karyawan $karyawan, $kdkaryawan = null)
	{
		isset($kdkaryawan) ? $data['karyawan'] = $karyawan->find($kdkaryawan) : $data['karyawan'] = new Karyawan();
		$data['jabatan'] = Jabatan::lists('jabatan', 'kdjabatan');

		if($request->isMethod('post')){
			if(!isset($kdkaryawan)){
				$karyawan->kdkaryawan = $karyawan->setKdKaryawan();
			}
			else{
				$karyawan->find($kdkaryawan);
			}

			$validator = $karyawan->validate($request->all());

			if($validator->fails()){
				return redirect()->back()
					->withErrors($validator)
					->withInput();
			}

			$karyawan->namadepan = $request->namadepan;
			$karyawan->namabelakang = $request->namabelakang;
			$karyawan->kdjabatan = $request->kdjabatan;
			$karyawan->jeniskelamin = $request->jeniskelamin;
			$karyawan->tempatlahir = $request->tempatlahir;
			$karyawan->tgllahir = $request->tgllahir;
			$karyawan->noktp = $request->noktp;
			$karyawan->notelepon = $request->notelepon;
			$karyawan->nohp = $request->nohp;
			$karyawan->email = $request->email;
			$karyawan->alamat = $request->alamat;
			$karyawan->kota = $request->kota;
			$karyawan->propinsi = $request->propinsi;

			$karyawan->save();

			return redirect()->route('karyawan')->with('success', 'Proses Insert Karyawan Berhasil');
		}
		return view('admin.tambahkaryawan', $data);
	}

	public function jabatan()
	{
		$data['jabatans'] = Jabatan::paginate(10);
		return view('admin.jabatan', $data);
	}

	public function level()
	{
		$data['levels'] = Level::paginate(10);
		return view('admin.level', $data);
	}

	public function user()
	{
		$data['users'] = User::with(['karyawans' => function($query) {
			$query->orderBy('namadepan', 'desc');
		}])->paginate(10);

//		$this->generateuser('kasir', 'kasir', 'KRY003', '03');

		return view('admin.user', $data);
	}

	public function generateuser($username, $passcode, $kdkaryawan, $level)
	{
		$model = new User();

		$model->iduser = Uuid::uuid4();
		$model->username = $username;
		$model->passcode = $passcode;
		$model->kdkaryawan = $kdkaryawan;
		$model->kdlevel = $level;

		$model->save();
	}
}
