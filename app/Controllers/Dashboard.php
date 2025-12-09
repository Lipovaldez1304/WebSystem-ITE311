<?php

namespace App\Controllers;

use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();

        // ✅ Use unified session key
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $role = $session->get('role');

        $data = [
            'name' => $session->get('name'),
            'role' => $role,
        ];

        // ========================================
        // ADMIN STATISTICS
        // ========================================
        if ($role === 'admin') {
            $userModel = new UserModel();
            
            $data['total_users'] = $userModel->countAll();
            $data['restricted_users'] = $userModel->where('is_restricted', 1)->countAllResults(false);
            $data['active_users'] = $userModel->where('is_restricted', 0)->countAllResults();
        }

        // ========================================
        // TEACHER DATA (for future use)
        // ========================================
        elseif ($role === 'teacher') {
            $data['pending_grading'] = 0; // TODO: Implement later
            $data['courses'] = []; // TODO: Fetch from database
        }

        // ========================================
        // STUDENT DATA (for future use)
        // ========================================
        elseif ($role === 'student') {
            $data['due_date'] = 'None'; // TODO: Implement later
            $data['grades'] = []; // TODO: Fetch from database
        }

        return view('auth/dashboard', $data);
    }
}
