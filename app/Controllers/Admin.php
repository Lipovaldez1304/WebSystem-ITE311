<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Admin extends BaseController
{
    // (🔒 Security) Require admin login for all admin pages
    private function secureAdmin()
    {
        $session = session();

        if (!$session->get('isLoggedIn') || $session->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        return null; // safe to continue
    }

    // -------------------------------------------------------
    public function manageUsers()
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $search = $this->request->getGet('search');

        if ($search) {
            // Search by ID, Name, or Email
            $users = $userModel->groupStart()
                               ->like('id', $search)
                               ->orLike('name', $search)
                               ->orLike('email', $search)
                               ->groupEnd()
                               ->findAll();
        } else {
            $users = $userModel->findAll();
        }

        $data = [
            'users' => $users,
            'restricted_count' => $userModel->where('is_restricted', 1)->countAllResults(),
        ];

        return view('admin/manage_users', $data);
    }

    // -------------------------------------------------------
    public function editUser($id)
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/manage-users')->with('error', 'User not found.');
        }

        return view('admin/edit_user', ['user' => $user]);
    }

    // -------------------------------------------------------
    public function updateUser($id)
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/manage-users')->with('error', 'User not found.');
        }

        $validation = \Config\Services::validation();

        $roleRule = ($user['role'] === 'admin')
            ? 'permit_empty'
            : 'required|in_list[teacher,student]';

        $validation->setRules([
            'name'  => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role'  => $roleRule,
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        if ($user['role'] !== 'admin') {
            $data['role'] = $this->request->getPost('role');
        }

        // ✅ FIX: Don't hash password manually - let UserModel handle it
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password; // UserModel will hash it via beforeUpdate hook
        }

        $userModel->update($id, $data);

        // ✅ Force logout if admin edited themselves
        $session = session();
        if ($id == $session->get('user_id') && $user['role'] === 'admin') {
            $session->destroy();
            return redirect()->to('/login')->with('success', 'Your profile was updated. Please log in again.');
        }

        return redirect()->to('/admin/manage-users')->with('success', 'User updated successfully!');
    }

    // -------------------------------------------------------
    public function restrictUser($id)
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/manage-users')->with('error', 'User not found.');
        }

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/manage-users')->with('error', 'Admin cannot be restricted.');
        }

        $userModel->update($id, ['is_restricted' => 1]);

        return redirect()->to('/admin/manage-users')->with('success', 'User restricted successfully!');
    }

    // -------------------------------------------------------
    public function unrestrictUser($id)
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/manage-users')->with('error', 'User not found.');
        }

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/manage-users')->with('error', 'Admin cannot be unrestricted.');
        }

        $userModel->update($id, ['is_restricted' => 0]);

        return redirect()->to('/admin/manage-users')->with('success', 'User unrestricted successfully!');
    }

    // -------------------------------------------------------
    public function addUserForm()
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        return view('admin/add_user');
    }

    // -------------------------------------------------------
    public function saveUser()
    {
        if ($redirect = $this->secureAdmin()) return $redirect;

        $userModel = new UserModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'name'  => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'role'  => 'required|in_list[admin,teacher,student]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ✅ Get and trim the password
        $password = trim($this->request->getPost('password'));
        
        // Use default password if none provided
        if (empty($password)) {
            $password = 'Rmmc1960';
        }

        // ✅ FIX: Don't hash password manually - let UserModel handle it
        $userModel->insert([
            'name'          => trim($this->request->getPost('name')),
            'email'         => trim($this->request->getPost('email')),
            'role'          => $this->request->getPost('role'),
            'password'      => $password, // UserModel will hash it via beforeInsert hook
            'is_restricted' => 0,
        ]);

        return redirect()->to('/admin/manage-users')->with('success', 'New user added successfully!');
    }
}
