<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
         'id' => [
            'type'           => 'INT',
            'constraint'     => 5,
            'unsigned'       => true,
            'auto_increment' => true,
         ],
         'username' => [
            'type'           => 'VARCHAR',
            'constraint'     => 20,
         ],
         'firstname' => [
            'type'           => 'VARCHAR',
            'constraint'     => 50,
         ],
         'lastname' => [
            'type'           => 'VARCHAR',
            'constraint'     => 50,
         ],
         'address' => [
            'type'           => 'TEXT',
         ],
         'age' => [
            'type'           => 'INT',
            'constraint'     => 3,
         ],
         'password' => [
            'type'           => 'VARCHAR',
            'constraint'     => 255,
         ],
         'salt' => [
            'type'           => 'VARCHAR',
            'constraint'     => 255,
         ],
         'avatar' => [
            'type'           => 'VARCHAR',
            'constraint'     => 255,
            'null' => true,
         ],
         'role' => [
            'type'           => 'INT',
            'constraint'     => 1,
            'default' => 1,
         ],
         'created_by' => [
            'type'           => 'INT',
            'constraint'     => 11,
         ],
         'created_date' => [
            'type'           => 'DATETIME',
         ],
         'updated_by' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'null' => true,
         ],
         'updated_date' => [
            'type'           => 'DATETIME',
            'null' => true,
         ],
      ]);

      $this->forge->addKey('id', true);
      $this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
