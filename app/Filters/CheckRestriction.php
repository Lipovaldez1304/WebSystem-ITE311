<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CheckRestriction implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Fix: Use correct session key 'isLoggedIn' not 'logged_in'
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        // Check if user is restricted
        if ($session->get('is_restricted') == 1) {
            // Log them out and redirect
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Your account has been restricted. Please contact the administrator.');
        }

        return null; // Important: return null to continue
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing needed here
    }
}
