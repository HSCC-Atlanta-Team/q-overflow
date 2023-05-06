<?php

namespace Qoverflow\Client;

use GuzzleHttp\Client;

class QClient extends Client
{
    public function __contstruct(array $config=[])
    {
        $stack = HandlerStack::create();
        $ratelimiter = RateLimiterMiddleware::perSecond(10, new InMemoryStore());
        $stack->push($ratelimiter);
        parent::__construct($config);
    }
}


