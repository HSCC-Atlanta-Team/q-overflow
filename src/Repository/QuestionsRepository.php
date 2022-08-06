<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\Answer;
use Qoverflow\Model\Comment;
use Qoverflow\Client\QClient;
use Qoverflow\Model\Question;
use Qoverflow\Controller\LoginController;

class QuestionRepository extends Repository
{
    protected $client;
    protected $f3;

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

    public function getQuestion($question_id)
    {
        try {
            $uri = sprintf('questions/%s', $question_id);
            $response = $this->client->request('GET', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public function updateVote($username, $question_id, $inc = true, $upvote = true)
    {
        $operation = ($inc) ? 'increment' : 'decrement';
        $target = ($upvote) ? 'upvotes' : 'downvotes';
        try {
            $uri = sprintf('questions/%s/vote/%s', $question_id, $username);
            $options = [
                'operation' => $operation,
                'target' => $target,
            ];
            $response = $this->client->request('PATCH', $uri, ['json' => $options]);
            if($response->getStatusCode() == 403){
                throw new \Exception('Operation not allowed.') 
            }
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getQuestionComments($question_id, $after = null)
    {
        try {
            $uri = sprintf('questions/%s/comments', $question_id);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $response = $this->client->request('GET', $uri, $options);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function deleteQuestionComment($question_id, $comment_id)
    {
        try {
            $uri = sprintf('questions/%s/comments/%s', $question_id, $comment_id);
            $response = $this->client->request('DELETE', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getQuestionAnswers($question_id, $after = null)
    {
        try {
            $uri = sprintf('questions/%s/answers', $question_id);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $response = $this->client->request('GET', $uri, $options);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function deleteAnswerComment($question_id, $answer_id, $comment_id)
    {
        try {
            $uri = sprintf('questions/%s/answers/%s/comments/$s', $question_id, $answer_id, $comment_id);
            $response = $this->client->request('DELETE', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateCommentVote($question_id, $answer_id, $comment_id, $username, $inc = true, $upvote = true)
    {
        $operation = ($inc) ? 'increment' : 'decrement';
        $target = ($upvote) ? 'upvotes' : 'downvotes';
        try {
            $uri = sprintf('questions/%s/answers/%s/comments/$s/vote/$s', $question_id, $answer_id, $comment_id, $username);
            $options = [
                'operation' => $operation,
                'target' => $target,
            ];
            $response = $this->client->request('PATCH', $uri, ['json' => $options]);
            if($response->getStatusCode() == 403){
                throw new \Exception('Operation not allowed.') 
            }
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateAnswerVote($question_id, $answer_id, $username, $inc = true, $upvote = true)
    {
        $operation = ($inc) ? 'increment' : 'decrement';
        $target = ($upvote) ? 'upvotes' : 'downvotes';
        try {
            $uri = sprintf('questions/%s/answers/%s/vote/$s', $question_id, $answer_id, $username);
            $options = [
                'operation' => $operation,
                'target' => $target,
            ];
            $response = $this->client->request('PATCH', $uri, ['json' => $options]);
            if($response->getStatusCode() == 403){
                throw new \Exception('Operation not allowed.') 
            }
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getAnswerComments($question_id, $answer_id, $after = null)
    {
        try {
            $uri = sprintf('questions/%s/answers/$s/comments', $question_id, $answer_id);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $response = $this->client->request('GET', $uri, $options);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    
}
