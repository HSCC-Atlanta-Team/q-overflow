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

    public function getCached($class, $id)
    {
        $cache = $this->f3->cache;
        $modelKey = $this->getModelName($class) . $id;
        if ($data = $cache->load($modelKey)) {
            $model = new $class($data);

            return $model;
        }

        return null;
    }

    private function getModelName($class)
    {
        $path = explode('\\', $class);

        return array_pop($path);
    }
}