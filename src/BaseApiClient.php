<?php

namespace Armandsar\PinnaclePineapple;

use GuzzleHttp\Client;
use Illuminate\Contracts\Config\Repository;

abstract class BaseApiClient
{
    protected $api_user;
    protected $api_password;

    protected $baseUrl = 'https://api.pinnacle.com';

    private $client;

    public function __construct(Client $client, Repository $config)
    {
        $this->api_user = $config->get('pinnacle_pineapple.user');
        $this->api_password = $config->get('pinnacle_pineapple.password');
        $this->client = $client;
    }

    protected function get($endpoint, $apiVersion = 'v1', $options = [], $returnAs = 'json')
    {
        $response = $this->request('GET', $endpoint, $apiVersion, $options)->getBody()->getContents();
        if ($returnAs == 'parseXml') {
            return simplexml_load_string($response);
        }
        return json_decode($response, true);
    }

    private function request($method, $endpoint, $apiVersion, $options)
    {
        $allOptions = [
            'auth' => $this->getAuthData(),
            'query' => $options
        ];

        return $this->client->request($method, $this->buildURL($endpoint, $apiVersion), $allOptions);
    }

    private function getAuthData()
    {
        return [$this->api_user, $this->api_password];
    }

    private function buildURL($endpoint, $apiVersion)
    {
        return $this->baseUrl . '/' . $apiVersion . '/' . $endpoint;
    }
}
