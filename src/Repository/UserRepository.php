<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\User;
use Qoverflow\Client\QClient;
use Qoverflow\Model\Answer;
use Qoverflow\Model\Comment;
use Qoverflow\Model\Question;
use Qoverflow\Controller\LoginController;

class UserRepository extends Repository
{

    public function getUsers($after = null)
    {
        try {
            $uri = 'users';
            $data = $this->client->multiRequest('GET', $uri, User::class, 'users');

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function createUser(User $user, string $password)
    {
        try {
            $uri = 'users';
            
            $data = $this->client->doRequest('POST', $uri, [
                'json' => $user->forCreateUser($password),
            ], 0 );

            if($data['success']) {
                $user = new User($data['user']);
            }

            return $user;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getUser($username)
    {
        if ($this->getCached(User::class, $username)) {
            return $this->getCached(User::class, $username);
        }

        try {
            $uri = sprintf('users/%s', $username);
            $data = $this->client->singleRequest('GET', $uri, User::class, 'user');

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function authUser(User $user, $password): bool
    {
        try {
            $uri = sprintf('users/%s/auth', $user->getUsername());

            // Don't cache auth requests - use the base 'request' here
            $response = $this->client->request('POST', $uri, [
                'json' => [
                    'key' => $user->getKey($password),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUserQuestions($username, $after = null)
    {
        try {
            $uri = sprintf('users/%s/questions', $username);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $data = $this->client->multiRequest('GET', $uri, Question::class, 'questions', $options);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getUserAnswers($username)
    {
        try {
            $uri = sprintf('users/%s/answers', $username, $after = null);
            if($after){
                $options = [
                    'query' => [
                        'after' => $after,
                    ],
                ];
            } else{
                $options = [];
            }
            $data = $this->client->multiRequest('GET', $uri, Answer::class, 'answers', $options);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateUser(User $user, $password = null): bool
    {
        try {
            $uri = sprintf('users/%s', $user->getUsername());
            $response = $this->client->request('PATCH', $uri, [
                'json' => $user->forUpdateUser($password),
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function changePassword($username, $password): bool
    {
        $salt = md5($username.$this->f3->get('secrets.SECRET_KEY'));
        $key = LoginController::deriveKey($username, $password, $this->f3->get('secrets.SECRET_KEY'));
        try {
            $options = [
                'salt' => $salt,
                'key' => $key,
            ];
            $uri = sprintf('users/%s', $username);
            $response = $this->client->request('PATCH', $uri, ['json' => $options]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteUser($username): bool
    {
        try {
            $uri = sprintf('users/%s', $username);
            $response = $this->client->doRequest('DELETE', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updatePoints($username, $points, $inc = true): bool
    {
        $operation = ($inc) ? 'increment' : 'decrement';
        try {
            $uri = sprintf('users/%s/points', $username);
            $options = [
                'operation' => $operation,
                'amount' => $points,
            ];
            $response = $this->client->request('PATCH', $uri, ['json' => $options]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data['success'] === true;
        } catch (\Exception $e) {
            return false;
        }
    }
}




