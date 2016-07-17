<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Level;
use App\Models\User;

use App\Http\Requests;
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
