<?php

namespace App\Controllers;

class Student extends BaseController
{
    public function dashboard()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($session->get('role') !== 'student') {
            return redirect()->to('/dashboard');
        }

        $data = [
            'name' => $session->get('name'),
            'role' => 'student',
        ];

        return view('student/dashboard', $data);
    }
}
