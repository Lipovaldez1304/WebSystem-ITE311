<?php
namespace App\Filters;  // ← This is correct for THIS file

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Check if user is logged in
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first.');
        }

        // If no specific role required, just check if logged in
        if (empty($arguments)) {
            return null;
        }

        // Get required role from arguments
        $roleRequired = $arguments[0] ?? null;
        $userRole = $session->get('role');

        // Check if user has the required role
        if ($userRole !== $roleRequired) {
            log_message('debug', "Role mismatch: User has '{$userRole}', but '{$roleRequired}' required");
            
            return redirect()->to('/dashboard')->with('error', 'Access denied. Insufficient permissions.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}