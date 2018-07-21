<?php

class RequestHelper
{
    private $validMethod;
    private $validUrl;
    private $ignore;

    public function __construct($validMethod, $validUrl, $ignore = false)
    {
        $this->validMethod = $validMethod;
        $this->validUrl = $validUrl;
        $this->ignore = $ignore;
    }

    public function makeRequest($method, $url)
    {
        $url = urldecode($url);
        if (!$this->ignore && ($this->validMethod !== $method || $this->validUrl !== $url))
            throw new RuntimeException("Invalid method or url | valid is {$this->validMethod}, {$this->validUrl}
             | provided {$method}, {$url}");
        return true;
    }
}
