<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateQuizzesTable extends Migration
{
   public function up()
{
    $this->forge->addField([
        'id'            => ['type' => 'INT', 'auto_increment' => true],
        'lesson_id'     => ['type' => 'INT'],
        'question'      => ['type' => 'TEXT'],
        'correct_answer'=> ['type' => 'VARCHAR', 'constraint' => 255],
        'created_at'    => ['type' => 'DATETIME', 'null' => true],
        'updated_at'    => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('quizzes');
}


    public function down()
    {
        //
    }
}
