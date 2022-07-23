<?php

namespace Qoverflow\Repository;

use Qoverflow\Model\User;
use Qoverflow\Client\QClient;

class UserRepository
{
    private $client;

    public function __construct(string $apiKey, QClient $client = null)
    {
        // if no client was provided, create one
        if (!$client) {
            $client = new QClient($apiKey);
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

    public function createUser(User $user, string $key)
    {
        try {
            $uri = 'users';
            $userData = $user->toArray();
            unset($userData['user_id']);
            unset($userData['points']);
            $response = $this->client->request('POST', $uri, [
                'json' => $userData + ['key' => $key], 
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
}

