<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubmissionsTable extends Migration
{
    public function up()
    {
    $this->forge->addField([
        'id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'user_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'quiz_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'score' => [
            'type'           => 'DECIMAL',
            'constraint'     => '5,2',
        ],
        'submitted_at' => [
            'type'       => 'DATETIME',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('submissions');
}

public function down()
{
    $this->forge->dropTable('submissions');
}
}
