<?php

namespace Qoverflow\Controller;

use Qoverflow\Repository\QuestionsRepository;

class QuestionController
{
    public function index($f3)
    {
        $repo = new QuestionsRepository();
        $questions = $repo->getQuestions();
        $f3->set('questions', $questions);
        $f3->set('template', 'templates/question_list.html');
    }
}