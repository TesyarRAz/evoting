<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$event = model('Event');

		$data = [
			'events' => $event
			->select('events.*')
			->select(
				'(select count(votings.id) from votings join teams on teams.id = votings.team_id where teams.event_id = events.id) as total_pemilih')
			->select(
				'(select count(users.id) - 1 from users) as pemilih'
			)
			->where('aktif', true)->findAll()
		];

		return view('admin/home', $data);
	}
}