<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\Answer;
use Qoverflow\Model\Comment;
use Qoverflow\Client\QClient;
use Qoverflow\Model\Question;
use Qoverflow\Controller\LoginController;

class QuestionsRepository extends Repository
{

    //public function for questions search
    public function getQuestions(array $query = [])
    {
        try {
            $uri = 'questions/search';
            
            $questions = $this->client->multiRequest('GET', $uri, Question::class, 'questions');

            return $questions;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }

    public function createQuestion(Question $question)
    {
        try {
            $uri = 'questions';

            $newQuestion = $this->client->doRequest('POST', $uri, [
                'json' =>  $question->forCreateQuestion(),
            ], 0 );

            return $newQuestion;
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
            

            $comment = $this->client->doRequest('POST', $uri, [
                'json' =>  $comment->toArray(),
            ], 0 );

            return $comment;
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

            $answer = $this->client->doRequest('POST', $uri, [
                'json' =>  $answer->toArray(),
            ], 0 );

            return $answer;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }

    public function createAnswerComment($question_id, $answer_id, Comment $comment)
    {
        try {
            $uri = sprintf('questions/%s/answers/%s/comments', $question_id, $answer_id);
            

            $answer = $this->client->singleRequest('POST', $uri, Comment::class, 'comment', [
                'json' =>  $comment->toArray(),
            ], false);

            return $answer;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }   
    }

    public function getQuestion($question_id)
    {
        if ($model = $this->getCached(Question::class, $question_id)) {
            return $model;
        }

        try {
            $uri = sprintf('questions/%s', $question_id);
            $question = $this->client->singleRequest('GET', $uri, Question::class, 'question');

            return $question;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    
    public function updateVote($username, $question_id, $inc = true, $upvote = true): bool
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

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
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
            $comments = $this->client->multiRequest('GET', $uri, Comment::class, 'comments', $options);

            return $comments;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }


    public function deleteQuestionComment($question_id, $comment_id): bool
    {
        try {
            $uri = sprintf('questions/%s/comments/%s', $question_id, $comment_id);
            $response = $this->client->doRequest('DELETE', $uri, [], false);

            return $response['success'] === true;
        } catch (\Exception $e) {
            return false;
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
            $answers = $this->client->multiRequest('GET', $uri, Answer::class, 'answers', $options);

            return $answers;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function deleteAnswerComment($question_id, $answer_id, $comment_id): bool
    {
        try {
            $uri = sprintf('questions/%s/answers/%s/comments/$s', $question_id, $answer_id, $comment_id);
            $response = $this->client->doRequest('DELETE', $uri, [], false);

            return $response['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function getAnswerComments($question_id, $answer_id, $after = null)
    {
        try {
            $uri = sprintf('questions/%s/answers/%s/comments', $question_id, $answer_id);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $comments = $this->client->multiRequest('GET', $uri, Comment::class, 'comments', $options);

            return $comments;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}

