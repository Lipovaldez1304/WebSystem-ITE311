<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Load cookie helper for set_cookie() and get_cookie()
        helper('cookie');
        
        $session = session();
        $mode = $arguments[0] ?? 'auth';

        if ($mode === 'noauth') {
            if ($session->get('isLoggedIn')) {
                return redirect()->to('/dashboard');
            }
        } else {
            if (!$session->get('isLoggedIn')) {
                return redirect()->to('/login')->with('error', 'Please log in first.');
            }

            // ✅ CHECK SESSION VERSION - Force logout if ROLE changed in database
            $userModel = new UserModel();
            $userId = $session->get('user_id');
            $sessionVersion = $session->get('session_version') ?? 1;

            $user = $userModel->find($userId);

            // If user not found, force logout
            if (!$user) {
                // Set cookie with error message
                set_cookie('logout_msg', 'User account not found.', 60);
                $session->destroy();
                return redirect()->to('/login');
            }

            // If session version mismatch (role was changed), force logout
            if ($user['session_version'] != $sessionVersion) {
                // Set cookie with error message
                set_cookie('logout_msg', 'Your role has been changed. Please log in again with your new permissions.', 60);
                $session->destroy();
                return redirect()->to('/login');
            }

            // Check if user is restricted
            if ($user['is_restricted'] == 1) {
                // Set cookie with error message
                set_cookie('logout_msg', 'Your account has been restricted.', 60);
                $session->destroy();
                return redirect()->to('/login');
            }
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing needed here
    }
}
