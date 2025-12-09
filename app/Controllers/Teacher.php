<?php

namespace App\Controllers;

class Teacher extends BaseController
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($session->get('role') !== 'teacher') {
            return redirect()->to('/dashboard');
        }

        $data = [
            'name' => $session->get('name'),
            'role' => 'teacher'
        ];

        return view('teacher/dashboard', $data);
    }
}
