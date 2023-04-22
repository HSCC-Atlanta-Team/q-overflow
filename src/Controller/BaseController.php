<?php

namespace Qoverflow\Controller;

use Qoverflow\Auth\Auth;

class BaseController 
{
    public function beforeroute($f3)
    {
        if (!Auth::isAuthenticated()) {
            $f3->reroute('/login');
        }
    }

    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');
    }
} 