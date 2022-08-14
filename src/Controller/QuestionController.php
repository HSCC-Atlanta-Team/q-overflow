<?php

namespace Qoverflow\Controller;

class QuestionController extends BaseController
{
    public function index($f3)
    {
        $f3->set('questions', [
            new \Qoverflow\Model\Question([
                'question_id' => 1,
                'title' => 'This is a test',
            ]),
        ]);
        $f3->set('comments', [
            new \Qoverflow\Model\Comment([
                'comment_id' => 1,
                'text' => 'this is my first comment',
                'upvotes' => "567",
                'downvotes' => 900,
                'creator' => "AbhiN",
                "createdAt" => 1660519061625
            ]),
            new \Qoverflow\Model\Comment([
                'comment_id' => 2,
                'text' => 'this is my second comment',
            ]),
        ]);
        $f3->set('answers', [
            new \Qoverflow\Model\Answer([
                'answer_id' => 1,
                'text' => 'My answer is to yolo!',
            ])
        ]);
        $f3->set('answerComments', [
            new \Qoverflow\Model\Comment([
                'comment_id' => 1,
                'text' => 'this is my first comment',
            ]),
        ]);
        $f3->set('template', 'templates/question_list.html');
    }
}