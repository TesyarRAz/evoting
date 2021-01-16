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

	public function attempt($credentials)
	{
		if (isset($credentials['password']))
		{
			$password = $credentials['password'];

			unset($credentials['password']);
		}

		$user = model('User')->where($credentials)->first();

		if (!empty($user) && isset($password))
		{
			if (password_verify($password, $user['password']))
			{
				$this->login($user);

				return true;
			}
		}
	}

	public function login($user)
	{
		session()->set('user_id', $user['id']);
	}

	public function logout()
	{
		session()->remove('user_id');
	}
}