<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
	public function up()
	{
		$this->forge
		->addField('id')
		->addField('name varchar(100) not null unique')
		->createTable('kelas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
