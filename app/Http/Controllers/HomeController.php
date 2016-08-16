<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth', [
//			'except' => ['index', 'frontLogin']
//		]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(Auth::check()){
			return view('home');
		}
		else{
			return view('welcome');
		}
    }


    public function frontLogin()
    {
		$rules = array( 'username' => 'required',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {
			$messages = $validator->messages();
            return Redirect::to('login')
                ->withInput(Input::except('password'))
                ->withErrors($validator);
        }
        else
        {
            $users = [
                'username'	=> Input::get('username'),
                'password'	=> Input::get('password')
            ];

            if(Auth::attempt($users)){
                return redirect()->intended('home');
            }
			else {
				return Redirect::to('login')
					->withErrors('Login gagal, silahkan cob lagi');
			}
        }
    }

	public function androidlogin()
	{
		$rules = array( 'username' => 'required',
			'password' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			$messages = $validator->messages();
			return $messages;
		}
		else
		{
			$users = [
				'username'	=> Input::get('username'),
				'password'	=> Input::get('password')
			];

			if(Auth::attempt($users)){
				return Auth::user();
			}
			else {
				return array(['errorusername' => 'Username or Password is Invalid']);
			}
		}
	}
}
