<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pemilih extends BaseController
{
	public function index()
	{
		$model = model('User');
		$data = [
			'pemilihs' => $model->whereNotIn('id', [service('auth')->id()])->paginate(10),
			'pager' => $model->pager
		];

		return view('admin/pemilih/index', $data);
	}
}