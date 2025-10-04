<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // Show registration form
    public function new()
    {
        helper(['form']);
        return view('auth/register');
    }

    // Process registration
    public function create()
    {
        helper(['form']);
        $users = new UserModel();

        $data = [
            'name'         => $this->request->getPost('name'),
            'email'        => $this->request->getPost('email'),
            'password'     => $this->request->getPost('password'),
            'pass_confirm' => $this->request->getPost('pass_confirm'),
            'role'         => 'student',  // ← FIXED: Changed from 'user' to 'student'
        ];

        if (!$users->save($data)) {
            // Redirect back with input + validation errors
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $users->errors());
        }

        return redirect()->to('/register/success')
                         ->with('success', 'Account created!');
    }

    // Show success page
    public function success()
    {
        return view('register_success');
    }

    // Show login form
    public function index()
    {
        helper(['form', 'url']);
        return view('auth/login');
    }

    // Process login
    public function auth()
    {
        $session = session();
        $users   = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $users->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sessionData = [
                    'id'         => $user['id'],
                    'name'       => $user['name'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],      // ← This is correct
                    'isLoggedIn' => true,
                ];
                $session->set($sessionData);

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Wrong password.');
            }
        } else {
            return redirect()->back()->with('error', 'Email not found.');
        }
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    // Dashboard
// In app/Controllers/Auth.php, replace your existing dashboard() method:

public function dashboard()
{
    $session = session();
    $role = $session->get('role');
    
    // 1. Perform Authorization Check (Lab Step 3.2)
    if (!$session->get('isLoggedIn')) {
        return redirect()->to('/login')->with('error', 'You must log in first.');
    }

    // Prepare base data for all views
    $data = [
        'name'  => $session->get('name'),
        'role'  => $role,
        'title' => ucfirst($role) . ' Dashboard'
    ];
    
    // 2. Fetch Role-Specific Data (Lab Step 3.2 - Using mock data for now)
    if ($role === 'admin') {
        // Data needed for the Admin Dashboard (e.g., system stats)
        $data['total_users'] = 500; 
        $data['pending_approvals'] = 12; 
        $data['latest_activity'] = 'System log updated.';

    } elseif ($role === 'teacher') {
        // Data needed for the Teacher Dashboard (e.g., courses they teach)
        $data['courses'] = ['Web Systems and Tech', 'Data Structures', 'Algorithms']; 
        $data['pending_grading'] = 8;

    } elseif ($role === 'student') {
        // Data needed for the Student Dashboard (e.g., their current grades)
        $data['grades'] = ['ITE 311: A', 'Programming 1: B+', 'General Ed: Pass']; 
        $data['due_date'] = '2025-10-15';
    }

    // 3. Pass the user's role and relevant data to the unified view [cite: 76]
    return view('auth/dashboard', $data);
}
}
