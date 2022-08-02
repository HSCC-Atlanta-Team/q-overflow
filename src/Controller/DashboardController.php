<?php

namespace Qoverflow\Controller;

use Qoverflow\Controller\BaseController;
use Qoverflow\Repository\UserRepository;

class DashboardController extends BaseController
{
    public function index ($f3)
    {
        $repo = new UserRepository($f3);
        $username = $f3->get('SESSION.user')->getUsername();
        $myQuestions = $repo->getUserQuestions($username);
        $myAnswers = $repo->getUserAnswers($username);

        $f3->set('questions', $myQuestions);
        $f3->set('answers', $myAnswers);
        $f3->set('template', 'templates/dashboard.html');
    }
}