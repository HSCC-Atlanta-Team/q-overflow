<?php

namespace Qoverflow\Controller;

class BaseController 
{
    public function beforeroute($f3)
    {

        if (!$f3->get('currentUser')->getUsername()) {
          //  $f3->reroute($f3->get('BASEURL').'/login');
        }

    }

    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');


    }

    
} 