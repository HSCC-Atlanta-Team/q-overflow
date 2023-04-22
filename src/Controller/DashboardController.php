<?php

namespace Qoverflow\Controller;

use Qoverflow\Controller\BaseController;
use Qoverflow\Repository\UserRepository;

class DashboardController extends BaseController
{
    public function index ($f3)
    {
        // $f3->set('currentUser', UserMock::getUser());
        // $f3->set('questions', QuestionMock::getQuestions());
        // $f3->set('answers', AnswerMock::getAnswers());

        $f3->set('template', 'templates/dashboard.html');
    }


}