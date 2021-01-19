<?php namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Event extends BaseController
{
	public function join($event_id)
	{
		$event = model('Event');
		$team = model('Team');
		$voting = model('Voting');

		if (!$event_data = $event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if (
			$voting
			->join('teams', 'teams.id = votings.team_id')
			->join('events', 'events.id = teams.event_id')
			->where('event_id', $event_id)
			->where('user_id', session('user_id'))
			->first()
		)
		{
			return redirect()->back()->with('status', 'Anda sudah pernah ikut vote');
		}

		if (!$event_data['aktif'])
		{
			return redirect()->back()->with('status', 'Event sudah berakhir');
		}

		$teams = $team->where('event_id', $event_id)->findAll();

		$data = [
			'teams' => $teams
		];

		return view('siswa/join', $data);
	}

	public function select($event_id, $team_id)
	{
		$event = model('Event');
		$team = model('Team');
		$voting = model('Voting');

		if (!$event->find($event_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if (!$team_data = $team->find($team_id))
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		if ($team_data['event_id'] != $event_id)
		{
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
		if (
			$voting
			->join('teams', 'teams.id = votings.team_id')
			->join('events', 'events.id = teams.event_id')
			->where('event_id', $event_id)
			->where('user_id', session('user_id'))
			->first()
		)
		{
			return redirect()->back()->with('status', 'Anda sudah pernah ikut vote');
		}
		if (!$event_data['aktif'])
		{
			return redirect()->back()->with('status', 'Event sudah berakhir');
		}

		$data = [
			'user_id' => session('user_id'),
			'team_id' => $team_data['id'],
		];

		if ($voting->insert($data))
		{
			return redirect()->to('/')->with('status', 'Berhasil nyoblos');
		}

		return redirect()->to('/')->with('status', 'Gagal nyoblos');
	}
}