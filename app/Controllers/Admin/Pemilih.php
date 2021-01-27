<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pemilih extends BaseController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index()
	{
		$user = model('User');
		$data = [
			'pemilihs' => $user->withKelas()->whereNotIn('users.id', [service('auth')->id()])->paginate(10),
			'kelasses' => model('Kelas')->orderBy('name')->findAll(),
			'pager' => $user->pager
		];

		return view('admin/pemilih/index', $data);
	}

	public function store()
	{
		helper('text');
		$user = model('User');

		$this->validate([
			'username' => 'required',
			'password' => 'required',
			'email' => 'required|valid_email'
		]);

		$data = $this->request->getVar([
			'name', 'kelas_id', 'email'
		]);

		$data['username'] = random_string();
		$data['password'] = random_string();
		$data['role'] = 'siswa';

		if ($user->insert($data))
		{
			return redirect()->back()->with('status', 'Berhasil tambah pemilih');
		}

		return redirect()->back()->with('status', 'Gagal tambah pemilih');
	}

	public function edit($user_id)
	{
		if ($this->request->isAJAX())
		{
			$user = model('User');

			if (!$user_data = $user->find($user_id))
			{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}

			unset($user_data['username']);
			unset($user_data['password']);

			return $this->respond($user_data);
		}
	}

	public function update($user_id)
	{
		$user = model('User');

		if (!$user->find($user_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		
		$this->validate([
			'username' => 'required',
			'password' => 'required',
			'email' => 'required|valid_email'
		]);

		$data = $this->request->getVar([
			'name', 'kelas_id', 'email'
		]);

		if ($user->update($user_id, $data))
		{
			return redirect()->back()->with('status', 'Berhasil edit pemilih');
		}

		return redirect()->back()->with('status', 'Gagal edit pemilih');
	}

	public function destroy($user_id)
	{
		$user = model('User');

		if (!$user->find($user_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($user->delete($user_id))
		{
			return redirect()->back()->with('status', 'Berhasil hapus pemilih');
		}

		return redirect()->back()->with('status', 'Gagal hapus pemilih');
	}

	public function import()
	{
		helper('text');

		$user = model('User');
		$kelas = model('Kelas');

		$delimiter = $this->request->getVar('delimiter');

		$data = file_get_contents($this->request->getFile('berkas')->getTempName());

		$rows = explode(PHP_EOL, trim($data));

        $result = [];
        
        unset($rows[0]);

        foreach ($rows as $row)
        {
            $cells = explode($delimiter, trim($row));

            if (count($cells) < 3)
            {
                return back()->with('status', 'Cell CSV minimal 3, untuk nama, nis, dan kelas');
            }

            $result[] = [
                'name' => trim($cells[0]),
                'kelas_id' => $kelas->where(['name' => trim($cells[1])])->first()['id'],
                'email' => isset($cells[2]) && !empty($cells[2]) ? $cells[2] : null,
                'username' => random_string(),
                'password' => random_string(),
                'role' => 'siswa',
            ];
        }

        if ($user->insertBatch($result))
        {
        	return redirect()->back()->with('status', 'Berhasil import siswa');
        }

        return redirect()->back()->with('status', 'Gagal import siswa');
	}

	public function email($user_id)
	{
		$user = model('User');

		if (!$user_data = $user->find($user_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		return $this->sendEmail($user_data);
	}

	public function emailBatch()
	{
		$user = model('User');

		$kelas_id = $this->request->getVar('kelas_id');

		if (empty($kelas_id))
		{
			return redirect()->back()->with('status', 'Kelas tidak boleh kosong');
		}

		$user_datas = $user->where('kelas_id', $kelas_id)->whereNotIn('id', [service('Auth')->id()])->findAll();

		foreach ($user_datas as $user_data)
		{
			$this->sendEmail($user_data);
		}

		return redirect()->back()->with('status', 'Berhasil kirim link verifikasi');
	}

	private function sendEmail($user_data)
	{
		$username = $user_data['username'];
		$password = $user_data['password'];
		$url_login = site_url('home/postLogin');

		$email = service('email');
		$email->setSubject('Akun Login Vote');
		$email->setTo($user_data['email']);
		$email->setMessage(
			<<< html
			<h3>Akun Anda Untuk Login Voting</h3>
			<p>Username : $username</p>
			<p>Password : $password</p>
			<form action="$url_login" method="post">
				<input type="hidden" name="username" value="$username">
				<input type="hidden" name="password" value="$password">
				<input type="submit" value="Klik Disini Untuk Login Dengan Mudah">
				Jika tidak bisa <a href="$url_login">Klik Disini</a>
			</form>
			html
		);
		
		if ($email->send())
		{
			return redirect()->back()->with('status', 'Berhasil kirim email login');
		}

		return redirect()->back()->with('status', 'Gagal kirim email login');
	}
}