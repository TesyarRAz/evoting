<?php namespace App\Controllers\Siswa;

use App\Controllers\BaseController;

class Home extends BaseController
{
	public function index()
	{
		$event = model('Event');

		$data = [
			'events' => $event->orderBy('id', 'desc')->findAll()
		];

		return view('siswa/home', $data);
	}
}