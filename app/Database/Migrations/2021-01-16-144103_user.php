<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge
		->addField('id')
		->addField([
			'name varchar(100) not null',
			'username varchar(50) not null unique',
			'password varchar(100) not null',
			'kelas_id' => [
				'type' => 'int',
				'null' => true
			],
			"role enum('siswa', 'guru', 'admin') not null default 'admin'",
			'phone varchar(15)',
		])
		->addForeignKey('kelas_id', 'kelas', 'id')
		->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
