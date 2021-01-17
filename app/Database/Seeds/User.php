<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
	public function run()
	{
		model('User')->insert([
			'username' => 'admin',
			'password' => password_hash('password', PASSWORD_DEFAULT),
			'name' => 'Admin',
			'role' => 'admin',
		]);
	}
}
