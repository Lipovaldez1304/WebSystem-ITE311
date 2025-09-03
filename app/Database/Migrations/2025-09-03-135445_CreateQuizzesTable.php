<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
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
        'lesson_id' => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
        ],
        'question' => [
            'type'       => 'TEXT',
        ],
        'answer' => [
            'type'       => 'TEXT',
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('quizzes');
}

public function down()
{
    $this->forge->dropTable('quizzes');
}
}
