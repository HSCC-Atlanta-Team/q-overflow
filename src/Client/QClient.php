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

    public function doRequest(string $method, $uri = '', array $options = [])
    {
        
        $f3 = \Base::instance();
        $sleep = floor(1000000 / $f3->get('RATE_LIMIT'));
        usleep((int)$sleep);
        
        return $this->request($method, $uri, $options);
    }
}

