<?php

namespace Qoverflow\Controller;

use Qoverflow\Model\Answer;
use Qoverflow\Model\Comment;
use Qoverflow\Model\Question;
use Qoverflow\Repository\UserRepository;
use SebastianBergmann\Template\Template;
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

//function for asking a question
    public function addQuestion($f3)
    {
        $title = $f3->get('REQUEST.question_title');
        $text = $f3->get('REQUEST.question_text');
        $question = new Question([
            'creator' => $f3->get('currentUser')->getUsername(),
            'title' => $title,
            'text' => $text,
        ]);
        $newQuestion = (new QuestionsRepository())->createQuestion($question);

        (new UserRepository())->updatePoints(
            $f3->get('currentUser')->getUsername, 
            1
        );
        
        $url = sprintf(
            '%s/questions/%s',
            $f3->get('BASEURL'),
            $newQuestion->getId()
        );

        $f3->reroute($url);
    }
    
//function for adding answer
    public function addAnswer($f3)
    {
        $qId = $f3->get('PARAMS.qid');
        $text = $f3->get('REQUEST.answer_text');

        $answer = new Answer([
            'creator' => $f3->get('currentUser')->getUsername(),
            'text' => $text,
        ]);
        $response = (new QuestionsRepository())->createAnswer($qId, $answer);

        (new UserRepository())->updatePoints(
            $f3->get('currentUser')->getUsername, 
            2
        );

        $url = sprintf(
            '%s/questions/%s',
            $f3->get('BASEURL'),
            $qId
        );

        $f3->reroute($url);
    }

//function for adding comment
    public function addComment($f3)
    {
        $qId = $f3->get('PARAMS.qid');
        $text = $f3->get('REQUEST.comment_text');

        $comment = new Comment([
            'creator' => $f3->get('currentUser')->getUsername(),
            'text' => $text,
        ]);
        $response = (new QuestionsRepository())->createComment($qId, $comment);

        $url = sprintf(
            '%s/questions/%s',
            $f3->get('BASEURL'),
            $qId
        );

        $f3->reroute($url);
    }

}