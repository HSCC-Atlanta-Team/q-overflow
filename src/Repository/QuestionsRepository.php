<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\Answer;
use Qoverflow\Model\Comment;
use Qoverflow\Client\QClient;
use Qoverflow\Model\Question;
use Qoverflow\Controller\LoginController;

class QuestionRepository extends Repository
{
    private $client;
    private $f3;

    public function __construct($f3, QClient $client = null)
    {
        $this->f3 = $f3;
        // if no client was provided, create one
        if (!$client) {
            $client = new QClient($f3->get('secrets.API_KEY'));
        }

        $this->client = $client;
    }

    //public function for questions search

    public function createQuestion(Question $question)
    {
        try {
            $uri = 'questions';
            

            $response = $this->client->request('POST', $uri, [
                'json' =>  $question->forCreateQuestion(),
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }

    public function createComment($question_id, Comment $comment)
    {
        try {
            $uri = sprintf('questions/%s/comments', $question_id);
            

            $response = $this->client->request('POST', $uri, [
                'json' =>  $question->forCreateComment(),
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }

    public function createAnswer($question_id, Answer $answer)
    {
        try {
            $uri = sprintf('questions/%s/answers', $question_id);
            

            $response = $this->client->request('POST', $uri, [
                'json' =>  $question->forCreateAnswer(),
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }
    
}