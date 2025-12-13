<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    // =======
    // LOGIN
    // =======

    public function login()
    {
        return view('auth/login');
    }


    public function loginPost()
    {
        $session = session();
        $model = new UserModel();



        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Authentication// 
        $user = $model->where('email', $email)->first();

        if (!$user) {
            $session->setFlashdata('error', 'Email not found.');
            return redirect()->to('/login');
        }

        if (!password_verify($password, $user['password'])) {
            $session->setFlashdata('error', 'Incorrect password.');
            return redirect()->to('/login');
        }

        // Check if user is restricted (only for non-admin users)
        if ($user['role'] !== 'admin' && $user['is_restricted'] == 1) {
            $session->setFlashdata('error', 'Your account has been restricted. Please contact the administrator.');
            return redirect()->to('/login');
        }

        // Set session with session_version
        $session->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'is_restricted' => $user['is_restricted'],
            'session_version' => $user['session_version'] ?? 1,
            'isLoggedIn' => true
        ]);

        return redirect()->to('/dashboard');
    }



    // ==========
    // REGISTER
    // ==========

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();

        // New registrations are students by default
        $userModel->insert([
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => $this->request->getPost('password'),
            'role'          => 'student',
            'is_restricted' => 0,
        ]);

        session()->setFlashdata('success', 'Registration successful! Please log in.');
        return redirect()->to('/login');
    }



    // ============
    // DASHBOARD
    // ============

    public function dashboard()
    {
        $session = session();

        // Authorization check - ensure user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please log in to access the dashboard.');
        }

        $role = $session->get('role');
        $name = $session->get('name');
        $userId = $session->get('user_id');

        // Validate role exists
        if (empty($role)) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Invalid session. Please log in again.');
        }

        $data = [
            'name' => $name,
            'role' => $role
        ];


        
        // Role-based data loading from database
        if ($role === 'admin') {
            $userModel = new UserModel();
            $data['total_users'] = $userModel->countAll();
            $data['restricted_users'] = $userModel->where('is_restricted', 1)->countAllResults();
            $data['active_users'] = $userModel->where('is_restricted', 0)->countAllResults();

        } elseif ($role === 'teacher') {
            // Load teacher-specific data from database
            $data['pending_grading'] = 0; 
            $data['courses'] = []; 
            // Example: $data['courses'] = $courseModel->where('teacher_id', $userId)->findAll();

        } elseif ($role === 'student') {
            // Load student-specific data from database
            $data['due_date'] = 'None'; 
            $data['grades'] = []; 
            // Example: $data['grades'] = $gradeModel->where('student_id', $userId)->findAll();
        }

        return view('auth/dashboard', $data);
    }

    // =========
    // LOGOUT
    // =========

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    
}
