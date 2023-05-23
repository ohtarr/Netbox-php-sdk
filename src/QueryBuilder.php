<?php

namespace Ohtarr\Netbox;

use \GuzzleHttp\Client as GuzzleClient;

class QueryBuilder
{
    public $baseurl;
    public $authheaders;
    public $search;

    public function __construct($params)
    {
        $this->baseurl = $params['baseurl'];
        if(isset($params['tokens']))
        {
            foreach($params['tokens'] as $token)
            {
                if(isset($token['prefix']))
                {
                    $this->authheaders[$token['header']] = $token['prefix'] . " " . $token['value'];
                } else {
                    $this->authheaders[$token['header']] = $token['value'];
                }
            }
        }
    }

    public function get($urlpath)
    {
        $headers = $this->authheaders;
        $guzzleparams = [
            'verb'      =>  'get',
            'url'       =>  $this->baseurl . $urlpath,
            'params'    =>  [
                'headers'   =>  $headers,
                'query' =>  $this->search,
            ],
            'options'   =>  [],
        ];
        $client = new GuzzleClient($guzzleparams['options']);
        $response = $client->request($guzzleparams['verb'], $guzzleparams['url'], $guzzleparams['params']);
        $body = $response->getBody()->getContents();
        $object = json_decode($body);
        $this->search = null;
        return $object;
    }

    public function first($urlpath)
    {
        $this->search['limit'] = 1;
        $response = $this->get($urlpath);
        if(isset($response->results))
        {
            return $response->results[0];
        }
    }

    public function where($column, $value)
    {
        $this->search[$column] = $value;
        return $this;
    }

    public function noPaginate()
    {
        unset($this->search['limit']);
        unset($this->search['offset']);
        return $this;
    }

    public function post($urlpath, $body)
    {
        $headers = $this->authheaders;
        $headers['Content-Type'] = 'application/json';
        $guzzleparams = [
            'verb'      =>  'post',
            'url'       =>  $this->baseurl . $urlpath,
            'params'    =>  [
                'headers'   =>  $headers,
                'body' => json_encode($body),
            ],
            'options'   =>  [],
        ];
        $client = new GuzzleClient($guzzleparams['options']);
        $response = $client->request($guzzleparams['verb'], $guzzleparams['url'], $guzzleparams['params']);
        $body = $response->getBody()->getContents();
        $object = json_decode($body);
        return $object;
    }

    public function put($urlpath, $body)
    {
        $headers = $this->authheaders;
        $headers['Content-Type'] = 'application/json';
        $guzzleparams = [
            'verb'      =>  'put',
            'url'       =>  $this->baseurl . $urlpath,
            'params'    =>  [
                'headers'   =>  $headers,
                'body' => json_encode($body),
            ],
            'options'   =>  [],
        ];
        $client = new GuzzleClient($guzzleparams['options']);
        $response = $client->request($guzzleparams['verb'], $guzzleparams['url'], $guzzleparams['params']);
        $body = $response->getBody()->getContents();
        $object = json_decode($body);
        return $object;
    }

    public function patch($urlpath, $body)
    {
        $headers = $this->authheaders;
        $headers['Content-Type'] = 'application/json';
        $guzzleparams = [
            'verb'      =>  'patch',
            'url'       =>  $this->baseurl . $urlpath,
            'params'    =>  [
                'headers'   =>  $headers,
                'body' => json_encode($body),
            ],
            'options'   =>  [],
        ];
        $client = new GuzzleClient($guzzleparams['options']);
        $response = $client->request($guzzleparams['verb'], $guzzleparams['url'], $guzzleparams['params']);
        $body = $response->getBody()->getContents();
        $object = json_decode($body);
        return $object;
    }

    public function delete($urlpath)
    {
        $headers = $this->authheaders;
        $headers['Content-Type'] = 'application/json';
        $guzzleparams = [
            'verb'      =>  'delete',
            'url'       =>  $this->baseurl . $urlpath,
            'params'    =>  [
                'headers'   =>  $headers,
            ],
            'options'   =>  [],
        ];
        $client = new GuzzleClient($guzzleparams['options']);
        $response = $client->request($guzzleparams['verb'], $guzzleparams['url'], $guzzleparams['params']);
        $body = $response->getBody()->getContents();
        $object = json_decode($body);
        return $object;
    }
}