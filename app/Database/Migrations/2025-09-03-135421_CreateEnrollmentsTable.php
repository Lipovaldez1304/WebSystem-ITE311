<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEnrollmentsTable extends Migration
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
        'course_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'enrolled_at' => [
            'type'       => 'DATETIME',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('enrollments');
}

public function down()
{
    $this->forge->dropTable('enrollments');
}
}
