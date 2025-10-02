<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function new()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function create()
{
    helper(['form']);
    $users = new UserModel();

    $data = [
        'name'     => $this->request->getPost('name'),
        'email'        => $this->request->getPost('email'),
        'password'     => $this->request->getPost('password'),
        'pass_confirm' => $this->request->getPost('pass_confirm'),
        'role'         => 'user',
    ];

    if (! $users->save($data)) {
            // redirect back with input + validation errors
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $users->errors());
        }

        return redirect()->to('/register/success')
                         ->with('success', 'Account created!');
}

    public function success()
    {
        return view('register_success');
    }
    public function index()
    {
        helper(['form', 'url']);
        return view('auth/login');
    }
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
                    'id'       => $user['id'],
                    'name' => $user['name'],
                    'email'    => $user['email'],
                    'role'     => $user['role'],
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

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    public function dashboard()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'You must log in first.');
        }

        return view('auth/dashboard');
    }
}
