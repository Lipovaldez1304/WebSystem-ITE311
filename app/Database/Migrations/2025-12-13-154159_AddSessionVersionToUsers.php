<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSessionVersionToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
        'session_version' => [
            'type'       => 'INT',
            'constraint' => 11,
            'default'    => 1, // Start all users at version 1
            'null'       => false,
        ],
    ]);
    }

    public function down()
    {
      $this->forge->dropColumn('users', 'session_version');
    }
}
