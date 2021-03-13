<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		if (session('role') == 'admin')
			return redirect()->to('/admin');
		else
			return redirect()->to('/siswa');
	}

	public function login()
	{
		return view('auth/login', [
			'is_admin' => isset($_GET['admin']),
			'is_allow_password' => true
		]);
	}

	public function postLogin()
	{
		$hash = isset($_GET['admin']);

		$credentials = $this->request->getPost(['username', 'password']);

		// Allow User To Login without password
		// if (!$hash)
		// {
		// 	unset($credentials['password']);
		// }

		if (service('auth')->attempt($credentials, $hash))
		{
			return redirect()->to('/');
		}
		else
		{
			return redirect()->back()->with('status', 'Username atau password salah!');
		}
	}

	public function logout()
	{
		service('auth')->logout();

		return redirect()->to('/');
	}

	public function setting()
	{
		return view('setting/index');
	}

	public function postSetting($params)
	{
		switch ($params) {
			case 'changePassword': return $this->changePassword();
		}

		return redirect()->back()->with('status', 'Hacker Ya?');
	}

	private function changePassword()
	{
		if (!$this->validate([
			'old_password' => 'required',
			'new_password' => 'required',
			'new_password_confirmation' => 'required'
		]))
		{
			return redirect()->back()->with('status', 'Input tidak boleh kosong');
		}

		$data = $this->request->getPost(['old_password', 'new_password', 'new_password_confirmation']);

		if (trim($data['new_password']) != trim($data['new_password_confirmation']))
		{
			return redirect()->back()->with('status', 'Password konfirmasi tidak sama');
		}

		if (password_verify($data['old_password'], service('auth')->user()['password']))
		{
			if (model('User')->update(service('auth')->id(), ['password' => password_hash(trim($data['new_password']), PASSWORD_DEFAULT)]))
			{
				return redirect()->back()->with('status', 'Berhasil ganti password');
			}

			return redirect()->back()->with('status', 'Gagal ganti password');
		}

		return redirect()->back()->with('status', 'Password lama tidak sama');
	}
}