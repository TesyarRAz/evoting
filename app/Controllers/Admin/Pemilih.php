<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pemilih extends BaseController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index()
	{
		$user = model('User');
		$data = [
			'pemilihs' => $user->whereNotIn('id', [service('auth')->id()])->paginate(10),
			'kelasses' => model('Kelas')->orderBy('name')->findAll(),
			'pager' => $user->pager
		];

		return view('admin/pemilih/index', $data);
	}

	public function store()
	{
		helper('text');

		$data = $this->request->getVar([
			'name', 'kelas_id', 'username', 'password', 'phone'
		]);

		if (empty($data['username']))
		{
			$data['username'] = random_string();
		}
		if (empty($data['password']))
		{
			$data['password'] = random_string();
		}

		if (model('User')->insert($data))
		{
			return redirect()->back()->with('status', 'Berhasil tambah pemilih');
		}

		return redirect()->back()->with('status', 'Gagal tambah pemilih');
	}

	public function edit($pemilih_id)
	{
		if ($this->request->isAJAX())
		{
			$user = model('User');

			if (!$pemilih = $user->find($pemilih_id))
			{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}

			return $this->respond($pemilih);
		}
	}

	public function update($pemilih_id)
	{
		$user = model('User');

		if (!$pemilih = $user->find($pemilih_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = $this->request->getVar([
			'name', 'kelas_id', 'username', 'password', 'phone'
		]);

		$pemilih->update($data);

		return redirect()->back()->with('Berhasil tambah pemilih');
	}

	public function destroy($pemilih_id)
	{
		$user = model('User');

		if (!$pemilih = $user->find($pemilih_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$user->delete($pemilih_id);

		return redirect()->back()->with('Berhasil hapus pemilih');
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
                'username' => isset($cells[2]) && !empty($cells[2]) ? $cells[2] : random_string(),
                'password' => isset($cells[3]) && !empty($cells[3]) ? $cells[3] : random_string(),
                'phone' => isset($cells[4]) && !empty($cells[4]) ? $cells[4] : null,
                'role' => 'siswa',
            ];
        }

        if ($user->insertBatch($result))
        {
        	return redirect()->back()->with('status', 'Berhasil import siswa');
        }

        return redirect()->back()->with('status', 'Gagal import siswa');
	}
}