<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kelas extends Seeder
{
	public function run()
	{
		$kelas = [
			"X AKL 1",
			"X AKL 2",
			"X AKL 3",
			"X BDP 1",
			"X BDP 2",
			"X BDP 3",
			"X OTKP 1",
			"X OTKP 2",
			"X RPL 1",
			"X RPL 2",
			"X TKJ 1",
			"X TKJ 2",
			"XI AKL 1",
			"XI AKL 2",
			"XI AKL 3",
			"XI BDP 1",
			"XI BDP 2",
			"XI BDP 3",
			"XI OTKP 1",
			"XI OTKP 2",
			"XI RPL 1",
			"XI RPL 2",
			"XI TKJ 1",
			"XI TKJ 2",
			"XII AKL 1",
			"XII AKL 2",
			"XII AKL 3",
			"XII BDP 1",
			"XII BDP 2",
			"XII BDP 3",
			"XII OTKP 1",
			"XII OTKP 2",
			"XII RPL 1",
			"XII RPL 2",
			"XII TKJ 1",
			"XII TKJ 2",
		];

		model('Kelas')->insertBatch(array_map(fn($item) => (['name' => $item]), $kelas));
	}
}
