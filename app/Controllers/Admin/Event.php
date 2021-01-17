<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Event extends BaseController
{
	use \CodeIgniter\API\ResponseTrait;

	public function index()
	{
		$event = model('Event');

		$data = [
			'events' => $event->paginate(10),
			'pager' => $event->pager
		];

		return view('admin/event/index', $data);
	}

	public function store()
	{
		helper('text');

		$data = $this->request->getVar([
			'name', 'aktif', 'keterangan', 'password'
		]);

		$data['aktif'] = !empty($data['aktif']);

		if (model('Event')->insert($data))
		{
			return redirect()->back()->with('status', 'Berhasil tambah event');
		}

		return redirect()->back()->with('status', 'Gagal tambah event');
	}

	public function edit($event_id)
	{
		if ($this->request->isAJAX())
		{
			$event = model('Event');

			if (!$pemilih = $event->find($event_id))
			{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}

			return $this->respond($pemilih);
		}
	}

	public function update($event_id)
	{
		$event = model('Event');

		if (!$data = $event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = $this->request->getVar([
			'name', 'aktif', 'keterangan', 'password'
		]);

		$data['aktif'] = !empty($data['aktif']);

		$event->update($data);

		return redirect()->back()->with('Berhasil tambah event');
	}

	public function destroy($event_id)
	{
		$event = model('Event');

		if (!$data = $event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$event->delete($event_id);

		return redirect()->back()->with('Berhasil hapus event');
	}
}