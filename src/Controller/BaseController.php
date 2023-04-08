<?php

namespace Qoverflow\Controller;

class BaseController 
{
    public function beforeroute($f3)
    {
    }

    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');
    }
} 