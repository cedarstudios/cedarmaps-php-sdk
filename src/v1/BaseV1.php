<?php


class BaseV1
{

    private $token;

    private $endpoint;

    public $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

}