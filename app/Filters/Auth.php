<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if(session('profile') != 1) {
            if(session('profile') == 2)  {
                return redirect()->route('index');
            } else {
             return redirect()->route('login');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}