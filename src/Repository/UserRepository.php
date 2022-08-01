<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\User;
use Qoverflow\Client\QClient;
use Qoverflow\Controller\LoginController;

class UserRepository extends Repository
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

    public function getUsers($after = null)
    {
        try {
            $uri = 'users';
            $response = $this->client->request('GET', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

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
            
            $response = $this->client->request('POST', $uri, [
                'json' => $user->forCreateUser($password),
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getUser($username)
    {
        try {
            $uri = sprintf('users/%s', $username);
            $response = $this->client->request('GET', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function authUser(User $user, $password)
    {
        try {
            $uri = sprintf('users/%s/auth', $user->getUsername());

            $response = $this->client->request('POST', $uri, [
                'json' => [
                    'key' => $user->getKey($password),
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
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
            $response = $this->client->request('GET', $uri, $options);

            $data = json_decode($response->getBody()->getContents(), true);

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
            $response = $this->client->request('GET', $uri, $options);
            $data = json_decode($response->getBody()->getContents(), true);

            return $data;       
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updateUser(User $user)
    {
        try {
            $uri = sprintf('users/%s', $user->getUsername());
            $userData = $user->toArray();
            unset($userData['user_id']);
            unset($userData['username']);
            unset($userData['salt']);
            $response = $this->client->request('PATCH', $uri, [
                'json' => $userData,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function changePassword($username, $password)
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

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function deleteUser($username)
    {
        try {
            $uri = sprintf('users/%s', $username);
            $response = $this->client->request('DELETE', $uri);

            $data = json_decode($response->getBody()->getContents(), true);

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function updatePoints($username, $points, $inc = true)
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

            return $data;
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}



