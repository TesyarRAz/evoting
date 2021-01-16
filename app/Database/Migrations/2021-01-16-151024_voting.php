<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voting extends Migration
{
	public function up()
	{
		$this->forge
		->addField('id')
		->addField([
			'team_id' => [
				'type' => 'int',
			],
			'user_id' => [
				'type' => 'int',
			],
		])
		->addForeignKey('team_id', 'teams', 'id')
		->addForeignKey('user_id', 'users', 'id')
		->createTable('votings');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('votings');
	}
}
