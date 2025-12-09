<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;

class ForceHttps implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Only apply to HTTP requests (skip localhost/127.0.0.1)
        $host = $request->getServer('HTTP_HOST');
        if ($host === 'localhost' || $host === '127.0.0.1') {
            return null;
        }

        // Redirect to HTTPS if the request is not secure
        if (!$request->isSecure()) {
            $uri = $request->getUri(); // Get URI object
            $httpsUrl = 'https://' . $uri->getHost() . $uri->getPath();

            // Append query string if it exists
            if ($uri->getQuery() !== '') {
                $httpsUrl .= '?' . $uri->getQuery();
            }

            // Permanent redirect (301)
            return redirect()->to($httpsUrl)->withStatus(301);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after response
        return $response;
    }
}

