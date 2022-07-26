<?php

namespace Api;

use GuzzleHttp\Exception\InvalidArgumentException;
use GuzzleHttp\Client;

class ReqresUser
{


    private $apiUrl = 'https://reqres.in/';


    public function prepareRequest()
    {
        $apiUrl = $this->apiUrl;

        $client = new Client([
            'base_uri' => $apiUrl,
            'timeout'  => 5,
        ]);

        return $client;
    }


    public function getUser($userID)
    {
        if (empty($userID)) {
            return 'User ID must not be empty.';
        }

        try {
            $client       = $this->prepareRequest();
            $response = $client->request('GET', 'api/users/'.$userID);
            $responseBody = $response->getBody()->getContents();
            return json_decode($responseBody);
        } catch (\Exception $e) {
            return false;
        }


    }


    public function getList($page)
    {
        if (empty($page)) {
            // Force page 1, or maybe throw an exception?
            $page = 1;
        }

        try {
            $client       = $this->prepareRequest();
            $response = $client->request('GET', 'api/users/?page=' . $page);
            $responseBody = $response->getBody()->getContents();
            return json_decode($responseBody);
        } catch (\Exception $e) {
            return false;
        }


    }


}