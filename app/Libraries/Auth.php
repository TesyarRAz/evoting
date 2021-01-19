<?php namespace App\Libraries;

/**
 * 
 */
class Auth
{
	public function id()
	{
		return session('user_id');
	}

	public function user()
	{
		$data = model('User')->find($this->id());

		if (empty($data))
		{
			auth()->logout();
			header('location: ' . site_url('/'));
		}

		return $data;
	}

	public function check()
	{
		return session()->has('user_id');
	}

	public function attempt($credentials, $hash = false)
	{
		if (isset($credentials['password']) && $hash)
		{
			$password = $credentials['password'];

			unset($credentials['password']);
		}

		$user = model('User')->where($credentials)->first();

		if (!empty($user))
		{
			if (isset($password) && !password_verify($password, $user['password']))
			{
				return false;
			}

			return $this->login($user);
		}
	}

	public function login($user)
	{
		session()->set('user_id', $user['id']);
		session()->set('role', $user['role']);
		session()->set('name', $user['name']);

		return true;
	}

	public function logout()
	{
		session()->destroy();

		return true;
	}
}