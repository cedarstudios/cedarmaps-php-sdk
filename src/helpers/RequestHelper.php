<?php


class RequestHelper
{

    private $client;
    private $BASE_URL = 'https://api.cedarmaps.com/v1';
    private $token;

    public function __construct($token)
    {
        $this->client = new GuzzleHttp\Client();
        $this->token = $token;
    }

    public function makeRequest($endpoint, $body, $method)
    {
        $token = $this->token;
        $baseUrl = $this->BASE_URL;
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => "Bearer ${$token}"
        ];

        $result = $this->client->request($method, "${baseUrl}/${endpoint}", $headers);

        if ($result->getStatusCode() > 400) {
            return [
                'successful' => false,
                'message' => $result->getBody()
            ];
        }

        $decodedBody = json_decode($result->getBody(), true);

        if ($decodedBody['status'] && $decodedBody['status'] !== 'OK') {
            return [
                'successful' => false,
                'message' => $decodedBody
            ];
        }

        return [
            'successful' => true,
            'message' => $decodedBody
        ];

    }
}