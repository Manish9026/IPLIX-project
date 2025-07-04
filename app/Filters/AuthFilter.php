<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;

class AuthFilter implements FilterInterface
{
   
public function before(RequestInterface $request, $arguments = null)
{
    $session = session();

    // Cast to IncomingRequest to access isAJAX()
    $incomingRequest = service('request');

    if (!$session->get('user')) {
        // For API requests:
        if ($incomingRequest->isAJAX() || $request->header('Accept') === 'application/json') {
            return service('response')
                ->setJSON(['status' => false, 'message' => 'Unauthorized'])
                ->setStatusCode(401);
        }

        // For regular web page
        return redirect()->to('./dashboard/login')->with('error', 'Please login to continue');
    }
}


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after request
    }
}
