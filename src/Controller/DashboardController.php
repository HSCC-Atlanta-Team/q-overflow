<?php

namespace Qoverflow\Controller;

use Qoverflow\Controller\BaseController;
use Qoverflow\Repository\UserRepository;

class DashboardController extends BaseController
{
    public function index ($f3)
    {
        $username = 'Demo User';
        $f3->set('template', 'templates/dashboard.html');
    }
}