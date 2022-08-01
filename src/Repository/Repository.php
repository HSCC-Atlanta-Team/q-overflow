<?php

namespace Qoverflow\Repository;

use GuzzleHttp\Client;
use Qoverflow\Client\QClient;

class Repository
{
    protected $f3;
    protected $client;

    public function __construct(?Client $client = null)
    {
        $this->f3 = \Base::instance();

        if ($client) {
            $this->client = $client;
        } else {
            $this->client = new QClient($this->f3->get('secrets.API_KEY'));
        }
    }
}