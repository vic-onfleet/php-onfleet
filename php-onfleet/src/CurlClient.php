<?php

namespace Onfleet;

class CurlClient
{
    const DEFAULT_URL = 'https://onfleet.com';
    const DEFAULT_PATH = '/api';
    const DEFAULT_API_VERSION = 'v2';
    const DEFAULT_TIMEOUT = 70000;

    protected $key;
    public $client;
    public $url = "";

    public function __construct($key) {

        if (!isset($key)) {
            //exception
        }
        $this->url = self::DEFAULT_URL . self::DEFAULT_PATH. "/". self::DEFAULT_API_VERSION;
        $this->client = curl_init();
        $this->key = $key ."11";
        curl_setopt($this->client, CURLOPT_USERPWD, $this->key . ":");
        curl_setopt($this->client, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->client, CURLOPT_CONNECTTIMEOUT, self::DEFAULT_TIMEOUT);
        curl_setopt($this->client, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($this->client, CURLOPT_SSL_VERIFYPEER, 1);

    }

    // not complete
    public function request($url, $params, $headers) {
        if (!empty($headers)) {
            curl_setopt($this->client, CURLOPT_HTTPHEADER, $headers);
        }
        if (!empty($params)) {

            curl_setopt($this->client, CURLOPT_POST, 1);
            curl_setopt($this->client, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($this->client, CURLOPT_URL, $this->url);
        $result = curl_exec($this->client);

    }

    public function testAuth(): bool
    {
        $this->url .= "/auth/test";
        curl_setopt($this->client, CURLOPT_URL, $this->url);
        curl_exec($this->client);

        $statusCode = curl_getinfo($this->client, CURLINFO_HTTP_CODE);

        if ($statusCode == 200) {
            return true;
        }

        return false;
    }

    public function __destruct() {
        curl_close($this->client);
    }
}