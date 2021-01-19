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
		$event = model('Event');

		$data = $this->request->getVar([
			'name', 'aktif', 'keterangan', 'password'
		]);

		$data['aktif'] = !empty($data['aktif']);
		$data['password'] = random_string();

		if ($event->insert($data))
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

			if (!$event_data = $event->find($event_id))
			{
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
			}

			return $this->respond($event_data);
		}
	}

	public function update($event_id)
	{
		$event = model('Event');

		if (!$event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data = $this->request->getVar([
			'name', 'aktif', 'keterangan', 'password'
		]);

		$data['aktif'] = !empty($data['aktif']);

		if ($event->update($event_id, $data))
		{
			return redirect()->back()->with('status', 'Berhasil edit event');
		}

		return redirect()->back()->with('status', 'Gagal edit event');
	}

	public function destroy($event_id)
	{
		$event = model('Event');

		if (!$event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($event->delete($event_id))
		{
			return redirect()->back()->with('status', 'Berhasil hapus event');
		}

		return redirect()->back()->with('status', 'Gagal hapus event');
	}

	public function chart($event_id)
	{
		$event = model('Event');
		$team = model('Team');

		if (!$event_data = $event
			->select('events.*')
			->select(
				'(select count(votings.id) from votings join teams on teams.id = votings.team_id where teams.event_id = events.id) as total_pemilih')
			->select(
				'(select count(users.id) - 1 from users) as pemilih'
			)
			->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($event_data['aktif'])
		{
			return redirect()->back()->with('status', 'Event belum selesai');
		}

		$teams = $team
		->select('teams.*')
		->select(
			'(select count(votings.id) from votings where votings.team_id = teams.id) as total_pemilih'
		)
		->where('event_id', $event_id)
		->findAll();

		$data = [
			'event' => $event_data,
			'teams' => $teams
		];

		return view('admin/event/status', $data);
	}

	public function pdf($event_id)
	{
		$event = model('Event');
		$team = model('Team');

		if (!$event_data = $event
			->select('events.*')
			->select(
				'(select count(votings.id) from votings join teams on teams.id = votings.team_id where teams.event_id = events.id) as total_pemilih')
			->select(
				'(select count(users.id) - 1 from users) as pemilih'
			)
			->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($event_data['aktif'])
		{
			return redirect()->back()->with('status', 'Event belum selesai');
		}

		$teams = $team
		->select('teams.*')
		->select(
			'(select count(votings.id) from votings where votings.team_id = teams.id) as total_pemilih'
		)
		->where('event_id', $event_id)
		->findAll();

		$total_pemilih_all = 0;
		$html = <<< html
			<h2 align="center">$event_data[name]</h2>
			<table width="100%" border="1" cellspacing="0" cellpadding="10">
				<thead>
					<tr>
						<th>Nama Kandidat</th>
						<th>Total Pemilih</th>
					</tr>
				</thead>
				<tbody>
			html;
		foreach($teams as $d)
		{
			$html .= <<< html
				<tr>
					<td>$d[name]</td>
					<td>$d[total_pemilih]</td>
				</tr>
				html;
			$total_pemilih_all += $d['total_pemilih'];
		}

		$html .= <<< html
					<tr>
						<td>Jumlah Pemilih</td>
						<td>$total_pemilih_all</td>
					</tr>
				</tbody>
			</table>
			html;

		$pdf = new \Dompdf\Dompdf;
		$pdf->load_html(
			<<< html
			<html>
				<head>
					<title>Dokumen Rahasia</title>
				</head>
				<body>
					$html
				</body>
			</html>
			html
		);

		$pdf->render();
		$pdf->stream();
		exit;
	}
}