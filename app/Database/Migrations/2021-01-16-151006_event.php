<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Event extends Migration
{
	public function up()
	{
		$this->forge
		->addField('id')
		->addField([
			'name varchar(100) not null',
			'keterangan varchar(100) not null',
			'aktif boolean not null default true',
			'password varchar(100)',
		])
		->createTable('events');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('events');
	}
}
