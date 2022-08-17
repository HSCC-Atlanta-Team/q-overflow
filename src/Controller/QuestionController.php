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
    public function view($f3)
    {
        $questionId = $f3->get('PARAMS.id');
        $repo = new QuestionsRepository();
        $question = $repo->getQuestion($questionId);

        $answers = $repo->getQuestionAnswers($questionId);
        $comments = $repo->getQuestionComments($questionId);

        $f3->set('question', $question);
        $f3->set('answers', $answers);
        $f3->set('comments', $comments);
        $f3->set('template', 'templates/question.html');
    }
    public function afterroute($f3)
    {
        echo \Template::instance()->render('templates/main.html');


    }
}