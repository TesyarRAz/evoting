<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * 
 */
class User extends Model
{
	protected $table = 'users';

	protected $protectFields = false;

	// protected $validationRules = [
	// 	'username' => 'required',
	// 	'password' => 'required',
	// ];

	public function withKelas()
	{
		return $this->select('users.*, kelas.name as kelas')->join('kelas', 'kelas.id = users.kelas_id');
	}
}