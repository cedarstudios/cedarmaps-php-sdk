<?php

namespace CedarMaps\Helpers;
class RequestHelper
{

    private $client;
    private $BASE_URL = 'https://api.cedarmaps.com/v1';
    private $token;

    public function __construct($token)
    {
        $this->client = new \GuzzleHttp\Client();
        $this->token = $token;
    }

    public function makeRequest($method, $endpoint, $body = null)
    {
        $token = $this->token;
        $baseUrl = $this->BASE_URL;
        $options = [
            'http_errors' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ]
        ];

        $result = $this->client->request($method, "${baseUrl}/${endpoint}", $options);
        if ($result->getStatusCode() >= 400) {
            return [
                'successful' => false,
                'status' => $result->getStatusCode(),
                'message' => (string)$result->getBody(),
            ];
        }

        $decodedBody = json_decode($result->getBody(), true);

        if ($decodedBody['status'] && $decodedBody['status'] !== 'OK') {
            return [
                'successful' => false,
                'status' => $result->getStatusCode(),
                'message' => $decodedBody,
            ];
        }

        return [
            'successful' => true,
            'status' => $result->getStatusCode(),
            'payload' => !empty($decodedBody['results']) ? $decodedBody['results'] : !empty($decodedBody['result']) ? $decodedBody['result'] : $decodedBody,

        ];

    }
}