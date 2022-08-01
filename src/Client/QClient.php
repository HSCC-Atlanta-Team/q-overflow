<?php

namespace Qoverflow\Client;

use GuzzleHttp\Client;

class QClient extends Client
{
    public function __construct(string $apiKey)
    {
        parent::__construct([
            'base_uri' => 'https://qoverflow.api.hscc.bdpa.org/v1/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => sprintf('bearer %s', $apiKey),
            ]
        ]);
    }
}

