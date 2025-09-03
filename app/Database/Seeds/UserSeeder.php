<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
         $data = [
        'name'      => 'Lipo Valdez',
        'email'     => 'lipovaldez1304@gmail.com',
        'password'  => password_hash('lipo1304', PASSWORD_DEFAULT),
    ];

    // add one user
    $this->db->table('users')->insert($data);

    // add nultiple users
    $users = [
        ['name' => 'Jane Smith', 'email' => 'jane.smite@email.com', 'password' => password_hash('password456', PASSWORD_DEFAULT)],
        ['name' => 'Juan Dela Crus', 'email' => 'Juan@email.com', 'password' => password_hash('pasword123', PASSWORD_DEFAULT)],
    ];

    $this->db->table('users')->insertBatch($users);
}
}
