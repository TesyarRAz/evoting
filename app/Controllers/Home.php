<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('admin/home');
	}

	public function login()
	{
		return view('auth/login');
	}

	public function postLogin()
	{
		if (service('auth')->attempt($this->request->getVar(['username', 'password'])))
		{
			return redirect()->to('/');
		}
		else
		{
			return redirect()->back()->with('status', 'Username atau password salah!');
		}
	}
}