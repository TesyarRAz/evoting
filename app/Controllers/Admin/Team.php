<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Team extends BaseController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index($event_id)
	{
		$event = model('Event');
		$team = model('Team');

		if (!$event_data = $event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = [
			'event_data' => $event_data,
			'teams' => $team->where('event_id', $event_id)->orderBy('id', 'desc')->paginate(10),
			'pager' => $team->pager
		];

		return view('admin/team/index', $data);
	}

	public function store($event_id)
	{
		helper('text');
		$event = model('Event');
		$team = model('Team');

		if (!$event_data = $event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = $this->request->getVar([
			'name', 'deskripsi'
		]);

		if (empty($this->request->getFile('gambar')))
		{
			return redirect()->back()->with('status', 'Harap Sertakan Gambar');
		}

		if (!$this->validate([
			'gambar' => 'is_image[gambar]'
		]))
		{
			return redirect()->back()->with('status', 'Format gambar tidak benar');
		}

		$gambar = $this->request->getFile('gambar');
		$gambar_name = $gambar->getRandomName();
		$gambar->move(FCPATH.'uploads', $gambar_name);

		$data['gambar'] = 'uploads/'.$gambar_name;
		$data['event_id'] = $event_id;

		if ($team->insert($data))
		{
			return redirect()->back()->with('status', 'Berhasil tambah team');
		}

		return redirect()->back()->with('status', 'Gagal tambah team');
	}

	public function edit($team_id)
	{
		if ($this->request->isAJAX())
		{
			$team = model('Team');

			if (!$team_data = $team->find($team_id))
			{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}

			return $this->respond($team_data);
		}
	}

	public function update($team_id)
	{
		$team = model('Team');

		if (!$team->find($team_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = $this->request->getVar([
			'name', 'deskripsi'
		]);

		if (!empty($this->request->getFile('gambar')))
		{
			if (!$this->validate([
				'gambar' => 'is_image[gambar]'
			]))
			{
				return redirect()->back()->with('status', 'Format gambar tidak benar');
			}

			$gambar = $this->request->getFile('gambar');
			$gambar_name = $gambar->getRandomName();
			$gambar->move(FCPATH.'uploads', $gambar_name);

			$data['gambar'] = 'uploads/'.$gambar_name;
		}

		if ($team->update($team_id, $data))
		{
			return redirect()->back()->with('status', 'Berhasil edit team');
		}

		return redirect()->back()->with('status', 'Gagal edit team');
	}

	public function destroy($team_id)
	{
		$team = model('Team');

		if (!$team->find($team_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($team->delete($team_id))
		{
			return redirect()->back()->with('status', 'Berhasil hapus team');
		}

		return redirect()->back()->with('status', 'Gagal hapus team');
	}
}