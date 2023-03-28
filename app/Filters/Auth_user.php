<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth_user implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if(session('login')) {

            } else {
             return redirect()->route('login');
            }
        }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}