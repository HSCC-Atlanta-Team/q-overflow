<?php

namespace Qoverflow\Controller;

class DashboardController 
{
    public function index ($f3)
    {
        $f3->set('template', 'templates/dashboard.html');
    }
}