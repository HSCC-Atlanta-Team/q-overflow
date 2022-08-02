<?php

namespace Qoverflow\Controller;

class DashboardController extends BaseController
{
    public function index ($f3)
    {
        $f3->set('template', 'templates/dashboard.html');
    }
}