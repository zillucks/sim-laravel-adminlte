<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Level;
use App\Models\User;

use App\Http\Requests;

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
		return view('admin.user', $data);
	}
}
