<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Team extends Migration
{
	public function up()
	{
		$this->forge
		->addField('id')
		->addField([
			'event_id' => [
				'type' => 'int',
			],
			'name text not null',
			'deskripsi text',
			'gambar text',
		])
		->addForeignKey('event_id', 'events', 'id')
		->createTable('teams');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('teams');
	}
}
