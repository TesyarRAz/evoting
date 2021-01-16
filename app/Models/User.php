<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * 
 */
class User extends Model
{
	protected $table = 'users';

	protected $protectFields = false;

	protected $validationRules = [
		'username' => 'required',
		'password' => 'required',
	];
}