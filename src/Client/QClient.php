<?php

namespace Qoverflow\Client;

use GuzzleHttp\Client;

class QClient extends Client
{
    protected $f3;

    public function __construct(string $apiKey = null)
    {
        $this->f3 = \Base::instance();

        parent::__construct([
            'base_uri' => 'https://qoverflow.api.hscc.bdpa.org/v1/',
            'http_errors' => false,
            'headers' => [
                'Authorization' => sprintf('bearer %s', $this->f3->get('secrets.API_KEY')),
            ]
        ]);
    }

    public function singleRequest($method, $uri, $class, $key = null, $options = [], $ttl = 180)
    {
        $cache = $this->f3->cache;
        $tags = [
            $this->getModelName($class),
            'single',
        ];

        $data = $this->doRequest($method, $uri, $options, $ttl, $tags);
        
        if ($key) {
            $data = $data[$key];
        }
        
        $model = new $class($data);

        return $model;
    }

    public function multiRequest($method, $uri, $class, $key = null, $options = [], $ttl = 180)
    {
        $cache = $this->f3->cache;
        $tags = [
            $this->getModelName($class),
            'multi',
        ];

        $data = $this->doRequest($method, $uri,  $options, $ttl, $tags);
        if ($key) {
            $data = $data[$key];
        }

        $items = [];
        foreach ($data as $item) {
            $model = new $class($item);
            $items[] = $model;
        }



        return $items;
    }

    public function doRequest($method, $uri, $options = [], $ttl = 180, $tags)
    {        
        $this->lastRequestKey = md5(sprintf(
            '%s%s%s',
            $method,
            $uri,
            json_encode($options)
        ));

        $cache = $this->f3->cache;

        if (!$data = $cache->load($this->lastRequestKey)) {
            $sleep = floor(1000000 / $this->f3->get('RATE_LIMIT'));

            usleep((int)$sleep);



            $response = parent::request($method, $uri, $options);
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['success'] === false || $response->getStatusCode() !== 200) {
                $error = $data['error'] ?? 'unknown';
                $retry = $data['retryAfter'] ?? 'unknown';
                $msg = sprintf('API request failed: %s retryAfter: %s', $error, $retry);
                error_log($msg);
                throw new \Exception($msg);
            }

            if ($ttl) {
                $cache->save($data, $this->lastRequestKey, $tags, $ttl);
            }

            
        } 

        return $data;
    }

        public function uncache(array $tags)
        {
            $cache = $this->f3->cache;
            $cache->clean($tags);
        }

        private function getModelName($class)
        {
            $path = explode('\\', $class);

            return array_pop($path);
        }
}


