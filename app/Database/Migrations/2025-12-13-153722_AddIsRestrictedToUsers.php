<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIsRestrictedToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
        'is_restricted' => [
            'type'       => 'TINYINT', // or BOOLEAN
            'constraint' => 1,
            'default'    => 0,
            'after'      => 'role', // or wherever you want it
        ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'is_restricted');
    }
}
